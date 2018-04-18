# GCC-gift-card-collector
## CS 3380, University of Missouri, Spring 2018

#### Team Members
- Austin Brown
- Zach Watson
- Jacob Zimmer

#### Abstract
_**Gift card collector**_ is a LAMP-powered database web application that tracks user gift card/certificate values. It supports multiple users, value updating, and usage history tracking on their respective cards/certificates until balance is fully spent. The objective of this application is to create a user-friendly and platform-agnostic interface that makes it convenient for users to quickly view where they have credit and how much is available. Many other "wallet-like" applications for the web or mobile devices make adding and spending balances on gift cards quick and convenient, but they rarely include meaningful support for places such as small businesses, local restaurants, or non-barcoded certificates. This is where _GCC_ truly shines: the application doesn't care what users choose as an identifier to track cards and certificates, as long as the entry has a location and a balance (and is SQL-friendly) then the rest is up to the individual.

#### Database Schema
- Users
    - id (int, PK, NN)
    - name (varchar, NN)
    - password (varchar, NN)
- CertifiCards
    - id (int, PK, NN)
    - location (varchar)
    - balance (float, NN)
    - serial (varchar)
    - dateAdded (date, NN)
    - balanceUpdate (datetime, NN)
    - expiration (date)
    - owner (int, NN)
- Transactions
    - id (int, PK, NN)
    - cardId (int, NN)
    - balanceDelta (float, NN)
    - date (datetime, NN)

#### Entity Relationship Diagram

#### CRUD Support

#### Video Demonstration