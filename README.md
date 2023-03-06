MergePHP Website
================

The static site generator and generated static site for MergePHP


Prerequisites
-------------

This project's dependencies are installed with [composer](https://getcomposer.org/).

You must have PHP 8.2 running on your machine (or be willing to build in a container with 8.2
installed)

Installation
------------

```bash
git clone https://www.github.com/mergephp/mergephp-website
cd mergephp-website
composer install
```

Build
-----

To generate a new meetup, run the following:
```bash
composer generate
```

You will be prompted for data for the meetup, then a new file will be placed in `src/Meetup`.
Next, build the site by running
```bash
composer build
```
**Important:** You _must_ run build every time you are changing meetup data or any files in the
`public` or `templates` directories.  This will re-generate the `docs` directory.

To view the site:
```bash
composer serve
```

A server with the site will be available at [http://localhost:8000/](http://localhost:8000/)

Finally, you can commit all your changes, keeping everything **in the same commit** and squashing
if necessary.  Then, open a pull request with your changes.

Development
-----------

If you are only modifying meetup data or any files in the `public` or `templates` directories
then the following is not necessary.  However if you make changes to other files in `src`:

First, check that your code meets the project's code style:
```bash
composer lint
```

If there are errors that can be fixed automatically, run
```bash
composer fix-lint-errors
```

Finally, run the tests:
```bash
composer test
```

Directory structure
-------------------
### docs
The live copy of the site is here.  It _is_ under version control because GitHub pages serves
the site directly from this folder.  Do not add or modify any files in this directory by hand;
any changes will be lost in the next build.

If you make changes to any files, the changes to the `docs` directory must be **in the same commit**.

Note: `dist` would be a better name for this folder, but [due to GitHub limitations][1] it must
be named docs.

### public
Files that need to be available on the live site (for example images and stylesheets) are in
this folder.  Its entire contents be copied to the live site, retaining their exact paths.

### src
This folder contains the source code to build the site as well as all the Meetup data.

### templates
This folder contains twig templates for layouts of various pages.

### tests
All unit tests are in this directory

Other
-----
### Why not use Sculpin or (another static site generator)?
Sculpin proved not to be customizable enough with regard to custom archive pages.
No other static site generators offered a featureset comparable Sculpin or what has been built
in this project.


1: https://docs.github.com/en/pages/getting-started-with-github-pages/configuring-a-publishing-source-for-your-github-pages-site#about-publishing-sources
