# base image
FROM node:18.16.0-alpine

# set working directory
WORKDIR /app

COPY ./frontend/package.json ./
# COPY ./.env ./.env

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH


COPY ./frontend .

# RUN
RUN npm install

RUN chown -R node /app/node_modules

USER node

# start app
CMD ["npm", "run", "dev"]