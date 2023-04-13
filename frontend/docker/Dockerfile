# base image
FROM node:16.19.0-alpine

# set working directory
WORKDIR /app

COPY ./package.json ./

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

RUN npm config set unsafe-perm true
RUN npm install
RUN npm install @vue/cli@3.7.0 -g


RUN chown -R node /app/node_modules

USER node

# start app
CMD ["npm", "run", "serve"]