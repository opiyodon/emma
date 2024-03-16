# E.M.M.A 
#### `- MENTAL HEALTH CHATBOT`
![EmmaAI Logo](http://localhost/emma/img/emma.jpg)

**E.m.m.a** is a conversational agent designed to mimic a psychotherapist in order to provide emotional support to people with anxiety & depression.
At its core, E.m.m.a is a chatbot trained on a text dataset using Deep Learning and Natural Language Processing techniques. 

E.m.m.a can provide general advice regarding anxiety and depression, answer questions related to mental health and make daily conversations. E.m.m.a is obviously not a licensed physician, and it does not make diagnoses or write prescriptions. E.m.m.a offers help and support rather than treatment. E.m.m.a is not equipped to deal with real mental health crises either. When it senses someone is in trouble, it suggests they seek help in the real world and provides text and hotline resources. E.m.m.a doesn’t seek to remove the human element in therapy either but is rather a “gateway therapy,” to give people a good first experience, and even help them realise when they need a more intense form of intervention.

## TECH STACKS

This project, `EmmaAI` has been created using the following Tech Stacks

```bash
-HTML
-CSS
-JAVASCRIPT
-PHP
-PYTHON
```

Other Technologies

```bash
-FLASK
-FLASKCORS
-TENSORFLOW
-PHPMAILER
-NLTK
-PANDAS
-SCIKITLEARN
-FLASK
```

# GET STARTED

First, clone this repository. Ensure you have Python and Pip installed in your machine. Pip comes pre-installed when you install python. Make sure you check the 
- [x] checkbox in the installer to automatically add python executable file path to the environment variables path.

### HOW TO RUN THIS REPOSITORY?
Open powershel and go to the folder directory by first going into the C drive using this command :
```bash
cd ../../../
```
then :
```bash
cd xampp >> cd htdocs >> cd emma >> cd server
```

If you are using Windows OS, bypass powershell default security that prevents runing python scripts using:
```bash
Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
```
Create a virtual environment using:
```bash
python -m venv emmaVirtualEnvironment
```
Activate the virtual environment using:
```bash
emmaVirtualEnvironment\Scripts\activate
```
Install the necessary libraries using:
```bash
pip install -r requirements.txt
```
Start Flask server and run the app using:
```bashpython app.py

```
Train the model using:
```bash
python model.py
```
Now run chat using:
```bash
python chat.py
```

You can modify E.m.m.a by inserting your own text in the `intents.json` file.

# A CONVERSATION WITH E.M.M.A
![sample-chat](http://localhost/emma/img/chat.jpg)

# DATASET
https://www.kaggle.com/datasets/elvis23/mental-health-conversational-data
