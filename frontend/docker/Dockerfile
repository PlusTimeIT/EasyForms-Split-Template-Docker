# base image
FROM node:18.16.0-alpine

# set working directory
WORKDIR /app

COPY ./frontend/package.json ./
COPY ./frontend/package-lock.json ./
# COPY ./.env ./.env

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

# RUN
RUN npm install

COPY ./frontend .

RUN chown -R node /app/node_modules

# start app
CMD ["npm", "run", "dev"]