from flask import Flask, request, url_for, redirect, render_template
import pickle
import numpy as np

app = Flask("mpg_prediction")

model = pickle.load(open('model_farm.pkl', 'rb'))


@app.route('/', methods=['GET'])
def hello_world():
    return ("hellow abeni")


@app.route('/', methods=['POST', 'GET'])
def predict():
    int_features = [float(x) for x in request.form.values()]
    final = [np.array(int_features)]
    print(int_features)
    print(final)
    # test = np.array([41.2, 11.5, 1, 11.2, 23.5, 45, 10, 4, 23])
    # test = test.reshape(1, -1)
    prediction = model.predict(final)
    # output = '{0:.{1}f}'.format(prediction[0][1], 2)

    if prediction > (0.5):
        return render_template('index.php', pred='Probability occurance {}'.format(prediction), bhai="kuch karna hain iska ab?")
    else:
        return render_template('index.php', pred='Probability of fire occuring is {}'.format(prediction), bhai="Your Forest is Safe for now")


if __name__ == '__main__':
    app.run(debug=True)
