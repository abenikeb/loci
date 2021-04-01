from flask import Flask, render_template, request
import pickle
import numpy as np

model = pickle.load(open('model_farm.pkl', 'rb'))

app = Flask(__name__)


@app.route('/')
def hello_world():
    return ("hellow abeni--")


@app.route('/predict_master', methods=['POST'])
def predict():
    int_features = [float(x) for x in request.form.values()]
    final = [np.array(int_features)]
    print(int_features)
    print(final)
    test = np.array([41.2, 11.5, 1, 11.2, 23.5, 45, 10, 4, 23])
    test = test.reshape(1, -1)
    prediction = model.predict(final)
   
    if 5 > (0.5):
#        return render_template('index.html', pred='Probability occurance {}'.format(prediction), bhai="kuch karna hain iska ab?")
       return render_template('index.html', pred=1)
    else:
        return render_template('index.php', pred='Probability of fire occuring is {}'.format(prediction), bhai="Your Forest is Safe for now")


if __name__ == "__main__":
    app.run(debug=True)
