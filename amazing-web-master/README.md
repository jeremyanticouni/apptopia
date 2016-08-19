# Requirements

This project requires [Node.js](https://nodejs.org/en/) for development and
release building. Please refer to your system's
[install instructions](https://nodejs.org/en/download/package-manager/).

[NPM](https://www.npmjs.com) is being used for dependency management. It is
bundled with Node.js.

# Installation

Make sure you have brunch:

```
npm install -g brunch
```

Within project dir install npm dependencies:

```
npm install
```

# Running

To start dev. server run:

```
brunch watch --server
```

The dev. server will be accessible via http://localhost:3333/

# Building/releasing

To make static build use

```
brunch build
```

To make production ready release do

```
brunch build --production
```

In both cases resulting build will be placed into `public` folder within project.
To build project from scratch, just remove the `public` folder and issue build
command again.
