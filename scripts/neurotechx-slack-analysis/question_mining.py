import requests
import json
import spacy
from gensim import corpora
from gensim.models.ldamodel import LdaModel
from pprint import pprint
import re


# 
# slackdump tool used to extract messages from the NeuroTechX Slack:
#   https://github.com/rusq/slackdump
# 


# Preprocess the documents using spaCy
def preprocess(doc):
    # Tokenize and preprocess each document
    doc = nlp(doc)
    # Lemmatize and remove stop words
    tokens = [token.lemma_ for token in doc if not token.is_stop]
    return tokens


nlp = spacy.load("en_core_web_sm")

messages_filenames = ["C073WP1T9.json",  # general
                      "C08PVFWH4.json",  # eegdata
                      "C08QEC5H7.json",  # introductions
                      "C08QFKWF2.json",  # tutorials
                      "C08S3426L.json",  # studentclubs
                      "C073WQK34.json",  # random
                      "C073X2ZQW.json",  # hacknights
                      "C3525BTBN.json"]  # neurotechedu

questions = []
questions_stripped = []


for messages_filename in messages_filenames:

    with open(f"scripts/neurotechx-slack-analysis/data/{messages_filename}", "r", encoding="utf-8") as messages_file:
        messages = messages_file.read()

        print(f"{messages_filename} - {len(messages.split("?"))}")
        for question in messages.split("?"):
            for split_char in ["?", ".", "!", "\n", "\r", '":"', '":{"', ',"title', ',"author_name']:
                if split_char in question:
                    question = question.split(split_char)[1]
            
            if " " in question and question not in questions:

                doc = nlp(question.lstrip())
                if len(doc) > 3:
                    questions.append(question)
                    questions_stripped.append(re.sub('[^A-Za-z0-9]+', ' ', question))
        
print("Questions extracted.")


# Apply preprocessing to each document
processed_questions = [preprocess(question) for question in questions_stripped]


# Create a dictionary and corpus for topic modeling with Gensim
dictionary = corpora.Dictionary(processed_questions)
corpus = [dictionary.doc2bow(question) for question in processed_questions]


# Build the LDA (Latent Dirichlet Allocation) model
lda_model = LdaModel(corpus, num_topics=3, id2word=dictionary, passes=10)

# Print the topics and their corresponding words
pprint(lda_model.print_topics(num_words=10))


# Perform semantic clustering
for i, question in enumerate(processed_questions):
    bow = dictionary.doc2bow(question)
    input(f"Document {i+1} belongs to topic: {lda_model.get_document_topics(bow)}")