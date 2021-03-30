import pandas as pd

import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.svm import SVC

import pickle

dt = pd.read_csv('locust_farm.csv')
data = np.array(dt)

# x = dt.drop('occ', axis='columns')
# y = dt['occ']
x = data[1:, 0:-1]
y = data[1:, -1]
y = y.astype('int')
x = x.astype('int')

x_train, x_test, y_train, y_test = train_test_split(
    x, y, test_size=0.2, random_state=5)

my_model = SVC().fit(x_train, y_train)
my_model.predict(x_test)
my_model.score(x_test, y_test)
my_model.predict([[41.2, 11.5, 1, 11.2, 23.5, 45, 10, 4, 23]])

pickle.dump(my_model, open('model_farm.pkl', 'wb'))
model = pickle.load(open('model_farm.pkl', 'rb'))
