# GCC-gift-card-collector
## CS 3380, University of Missouri, Spring 2018

### Team Members
- Austin Brown
- Zach Watson
- Jacob Zimmer

### Abstract
_**Gift card collector**_ is a LAMP-powered database web application that tracks user gift card/certificate values. It supports multiple users, value updating, and usage history tracking on their respective cards/certificates until balance is fully spent. The objective of this application is to create a user-friendly and platform-agnostic interface that makes it convenient for users to quickly view where they have credit and how much is available. Many other "wallet-like" applications for the web or mobile devices make adding and spending balances on gift cards quick and convenient, but they rarely include meaningful support for places such as small businesses, local restaurants, or non-barcoded certificates. This is where _GCC_ truly shines: the application doesn't care what users choose as an identifier to track cards and certificates, as long as the entry has a location and a balance (and is SQL-friendly) then the rest is up to the individual.

### Database Schema
#### Users
|Field    |Type         |Null |Extra  |
|---------|-------------|-----|-------|
|id       |int(11)      |NO   |AI, PK |
|name     |varchar(255) |NO   |       |
|password |varchar(255) |NO   |       |

#### Certificards
|Field      |Type         |Null |Extra  |
|-----------|-------------|-----|-------|
|id         |int(11)      |NO   |AI, PK |
|location   |varchar(255) |YES  |       |
|balance    |decimal(6,2) |NO   |       |
|serial     |varchar(255) |YES  |       |
|dateAdded  |date         |NO   |       |
|expiration |date         |YES  |       |
|owner      |int(11)      |NO   |FK     |

#### Transactions
|Field        |Type         |Null |Extra  |
|-------------|-------------|-----|-------|
|id           |int(11)      |NO   |AI, PK |
|cardId       |int(11)      |NO   |FK     |
|balanceDelta |decimal(6,2) |NO   |       |
|date         |datetime     |NO   |       |

### Entity Relationship Diagram
![ERD](https://github.com/jlzimmer/GCC-gift-card-collector/blob/master/3380Final.png "ERD")

### CRUD Support
- Create
    - Clicking the Sign Up button registers a new user to use the service
    - Users create new cards and certificates to fill their virtual wallet
- Read
    - Each time the Wallet button is clicked, the database reads out the contents of the logged-in user's virtual wallet
    - Each entry in the wallet has a View Transactions button that displays all balance history on the selected object
- Update
    - When a user clicks Update Balance, an entry is written to the transactions table that is tied to a single card or certificate, and that object's balance is updated in the wallet menu
- Delete
    - Users can delete an item in their wallet by navigating to the transactions page, selecting the delete button, and confirming their action on the modal that appears

### Video Demonstration
https://www.youtube.com/watch?v=rM4WQKBxZIY