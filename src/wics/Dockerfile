# Dockerfile
FROM node:7.8.0

# Create app directory
RUN mkdir -p /usr/src/app
WORKDIR /usr/src/app

# Install app dependencies
COPY package.json /usr/src/app/
RUN yarn install

# Bundle app source
COPY . /usr/src/app

# Build and optimize react app
RUN npm run build

EXPOSE 9000

# Defined in package.json
CMD [ "npm", "run", "start:server" ]
