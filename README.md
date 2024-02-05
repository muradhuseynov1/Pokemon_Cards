# Basic Functions
## Data, Preperations
The task is to create a server-side application written in PHP, in which users can trade Pokémon cards.
- Pokémon cards should be prepared in the data storage in advance.
- The users should include an __admin__ user, whose login details are fixed and who acts as a merchant. For details, see Admin functions.
- A card can only belong to one user, but a user can have more than one card.

## Main page / List page
- The listing page, or main page, should display a title and a short description as static text.
- The main page is accessible to unauthenticated users who can freely browse the content displayed here.
- The list page should list the Pokémon cards that exist in the system.
- Each Pokémon card should have a link (this could be in the form of an image) to the detail page of the Pokémon card (Card details page).
- If the user is logged in, a "Buy" button should be available on cards that belong to the admin. The user can buy a card if they have enough money and if they have not yet reached a card limit (e.g. 5 cards).
- If the user is logged in, a link should be available to the "User details" page.

## Card details page
- The Pokémon card details page displays the name of the monster on the card, its picture, the monster's properties, and a description of the card.
- On the page, a characteristic attribute (e.g. image background, page background color) should change according to the monster's element on the card. For example: red for Fire, yellow for Lightning, etc.
- From here you can also access the main page, and possibly other menu items.

## User details page
- The page lists the user's details and his/her own cards.
- The user can sell any card for 90% of the price to the admin user. The sold card will be returned to the admin user.

## Authentication pages
- The login and registration pages should be accessible from the main page.
- When registering, you must enter your username, email address and password twice. Each is mandatory, the username must be unique, the email address must be in the correct format and the passwords must match. In case of a successful registration, the user should receive X amount of money (it is recommended to burn this amount into the code, because you want all users to receive the same amount of money anyway).
- In case of registration failure, error messages should be displayed! The form should keep the state! After successful registration, the user will be logged in to the main page.
- During the login we can identify ourselves with the username and password.
- Report any errors during login above the form! After successful login, you will be redirected to the main page!

## Admin functions
- Create a special user, admin (username: __admin__, password: __admin__).
- The admin user should be able to create new cards.
- The admin user can have any number of cards.
- The admin user cannot buy cards.

## Extra features
- Admin: Card modification: available to admin user for cards not yet sold
- Admin: Card modification: error handling, status maintenance, successful save

## Other requirements
- A nice appearance is important. This doesn't necessarily mean making a page that looks fancy, but it does mean making a page that looks good at 1024x768 resolution. This can be done using a minimalist design, you can create your own CSS with different background images and graphical elements, or you can use any CSS framework.
- The input data should be checked on the server side when the request is processed. Include the __novalidate__ attribute in the attributes of theelements of the forms to disable browser validation!
- NO framework, external PHP library can be used to implement this. At most CSS frameworks can be used.

## Data storage
- Data: there are two types of data in the assignment: Pokémon card and User.
  - The Pokémon cards must have the following data stored:
      - Name of the Pokémon on the card
      - HP points of the Pokémon monster on the card
      - Element of the Pokémon on the card
      - Attack power of the Pokémon on the card
      - Defense of the Pokémon on the card
      - Card price
      - Description of the Pokémon on the card (optional)
      - Image of the card - this can be an image file path or image title (optional)
      - (possibly the user ID it belongs to)
  - User details:
      - User name
      - User email address
      - User's password
      - Is admin?
      - (possibly the User's cards)
<<<<<<< HEAD
- You can find all Pokémon cards are on this page, for inspiration: https://www.pokemon.com/us/pokemon-tcg/pokemon-cards/
=======
- You can find all Pokémon cards are on this page, for inspiration: https://www.pokemon.com/us/pokemon-tcg/pokemon-cards/
>>>>>>> 0afeb02663ce1383b5982e6f746da16d798efd98
