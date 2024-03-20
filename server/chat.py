import os
import json
import random
import pickle
import numpy as np
from tensorflow import keras
from openai import ChatCompletion
from dotenv import load_dotenv
from tensorflow.keras.preprocessing.sequence import pad_sequences

# Load intents.json file
with open('intents.json', encoding='utf-8') as file:
    data = json.load(file)

# Load trained model
model = keras.models.load_model('chat-model.keras')

# Load tokenizer object
with open('tokenizer.pickle', 'rb') as handle:
    tokenizer = pickle.load(handle)

# Load label encoder object
with open('label_encoder.pickle', 'rb') as enc:
    lbl_encoder = pickle.load(enc)

# Load environment variables from .env file
load_dotenv()

# Initialize OpenAI GPT-3.5 Turbo
client = ChatCompletion(api_key=os.getenv('OPENAI_API_KEY'))

def get_response(user_message, history):
    # Load intents
    with open('intents.json') as json_file:
        data = json.load(json_file)

    # Check if user_message matches any pattern in intents.json
    for intent in data['intents']:
        for pattern in intent['patterns']:
            if re.search(pattern, user_message, re.IGNORECASE):
                # If there's a match, return a random response for the corresponding intent
                return random.choice(intent['responses'])

    # If no match was found in intents.json, generate a response using OpenAI
    return generate_response_with_openai(user_message, history)

def generate_response_with_openai(user_message, history):
    prompt = f"{user_message} {history}"
    response = client.create(
        model="gpt-3.5-turbo",
        messages=[
            {"role": "system", "content": "You are a helpful assistant."},
            {"role": "user", "content": prompt}
        ]
    )
    # Access the message attribute of the Choice object
    return response.choices[0].message['content']  # Return the generated response