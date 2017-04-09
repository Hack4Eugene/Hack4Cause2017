# A Family For Every Child Team

Project repository for [Hack For A Cause](https://hackforacause.io)


## Table of Contents

- [Technologies](#technologies)
- [Resources Used](#resources-used)
- [Install](#install)
- [Running with Docker](#running-with-docker)
- [Contribute](#contribute)
- [License](#license)


## Technologies

- [React.js](https://facebook.github.io/react/) - Facebook's popular JavaScript front-end framework.
- [Node.js](https://nodejs.org/en/) - Our runtime server uses Node.
- [Express.js](https://expressjs.com/) - A backend framework for Node.
- [PostgreSQL](https://www.postgresql.org/) - Our database uses Postgres.
- [Create-React-App](https://github.com/facebookincubator/create-react-app) - Facebook's generator (think boilerplate, but more) in response to critique of React being difficult to learn.
- [Docker](https://docker.com) - Deployment tool from the gods.
- [Webpack](https://webpack.js.org/) - Webpack acts as a module bundler and almost entirely dispenses with the need for a task runner, like Grunt or Gulp.
- [Babel](https://babeljs.io/) - JavaScript compiler to unify all the different versions of JS that may have been used or will be used in the future.
- [Yarn](https://yarnpkg.com/) - Facebook's open source JavaScript package manager. There are a few differences between Yarn and Node Package Mangaer (npm), but the main differentiation is that Yarn locks dependencies so your project doesn't break when external resources change their code.
- [npm](https://www.npmjs.com/) - While Yarn is handling our projects dependencies, we still use npm to run scripts as you'll see further below.
- [Sass](http://sass-lang.com) - CSS Preprocessors make stylesheets faster to develop and easier to maintain.


## Resources Used

- [Learning React With Create-React-App](https://medium.com/@diamondgfx/learning-react-with-create-react-app-part-1-a12e1833fdc)
- [What Is Webpack?](https://survivejs.com/webpack/what-is-webpack/)
- [Routed React with Express.js and Docker](https://medium.com/@patriciolpezjuri/using-create-react-app-with-react-router-express-js-8fa658bf892d)
- [React Lifecycle Methods - How And When To Use Them](https://engineering.musefind.com/react-lifecycle-methods-how-and-when-to-use-them-2111a1b692b1)
- [Let's test React components with TDD, Mocha, Chai, and jsdom](https://medium.freecodecamp.com/simple-react-testing-d9e25ec87e2)


## Install
*Follow these instructions to contribute to the project.*

**Clone this repository:**

- `git clone https://github.com/WiCS-HFAC/AFFECT.git`

- `cd AFFECT`

**Install Node.js and NPM if you don't already have it.**

**Install Yarn:**

- `npm install -g yarn`

**Install dependencies:**

- `yarn install`

*You're ready to code!*

- `npm start` - This begins the development server.

- `npm run build` - This bundles the application into static files for production (minimization, post-processing, etc.)

- `npm test` - This starts the test runner.


## Running with Docker

Be sure to install Docker and start a Docker-machine if necessary.

Create a Docker image:

- `docker build -t AFFECT`

Start container:

- `docker run -p 80:9000 --name AFFECT-instance AFFECT`


## Contribute

Please refer to our Waffle board for tasks that need doing!

[![Stories in Ready](https://badge.waffle.io/WiCS-HFAC/AFFECT.svg?label=ready&title=Ready)](http://waffle.io/WiCS-HFAC/AFFECT)


## License

[MIT](LICENSE) © A Family For Every Child