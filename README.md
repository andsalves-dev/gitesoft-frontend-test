
## About Application Execution

All terminal commands are executed in root dir of project.

### Dependencies/npm

React 16+, npm 5.5.x, redux 3.7.x were used.<br>
To install dependencies, is necessary to have npm installed.
With npm, run the following command to install dependencies:

-- $ npm install

### Running Application

To run the application, we have to run a local npm server or build and run
a production server. <br>
To run the project locally, run:

-- $ npm start

Note that port 3000 will be used.

The php script used as data source cannot be executed directly by the react application.<br>
So, to access it, we have to run a php server pointing to the script. Like following:

-- $ php -S 0.0.0.0:8001 public/weather.php

Now the application can make requests to weather.php through localhost:8001/weather.php successfully.<br>
Notice that the app will check the current domain of application, using as base to define the script path.<br>
So, if application runs at 194.32.12.68:3000, it will search as data source in 194.32.12.68:8001/weather.php.<br>
This is defined in src/actions/weatherActions.js.

### Remarks

- The project were made in Linux, Manjaro Dist, Arch based. 
- React was the Js Framework used. Also, Redux, Axios and other js tools ware used.
- Bootstrap css was also included.
- The created or most edited directories/files were:
  - /src/*
  - /public/weather.php
  - /public/weatherMock.php
  - /packages.json
- The mirrored API sometimes is very slow. 
Maybe that depends on the location you're in. In my case, request it from Fortaleza/Brazil is too slow. Because of this, I created a mocked version of the script, but that is not used in final result. 
- To make a production build, you can run: npm run build

### Troubleshooting

- npm different versions can do some headache. If you in trouble by run npm install or npm start, try to update npm with:
  - $ npm i -g npm@5.5.1
- The application will not run properly if data source is not configured like described here. Make sure the requests are going to a valid source. 
