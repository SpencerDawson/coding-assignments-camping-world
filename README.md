# Camping World (Project Only)

This branch has only the symfony project, and a saved `.env.dev` file to go with it. You will need to point it to a postgreSQL DB instance and update `.env.dev` accordingly, and run init migration.

## Assignment

> I need you to build a webpage where I can import the attached CSV, and show the results in a table setting. We expect to be able to sort each column. The sort options should be ascending and descending. We also need an option to search the ‘table’ and show the results, relating to what we placed in the search field.

File provided: [cw_makebrands.csv](https://github.com/SpencerDawson/coding-assignments-camping-world/blob/main/cw_makebrands.csv)

## Assumptions

There are some assumptions made, simply for expediancy. Namely in the generation of records for campers and prices for uploads, the program assumes a given format, akin to the one provided. 

## Regarding .env files

.env files are stored in this project, as a sample only. files with sensitive information should never be shared in a repository and should be kept either locally or stored in a docker secret.

