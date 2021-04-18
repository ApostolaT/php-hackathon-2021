# PHP Hackathon
This document has the purpose of summarizing the main functionalities your application managed to achieve from a technical perspective. Feel free to extend this template to meet your needs and also choose any approach you want for documenting your solution.

## Problem statement
*Congratulations, you have been chosen to handle the new client that has just signed up with us.  You are part of the software engineering team that has to build a solution for the new client’s business.
Now let’s see what this business is about: the client’s idea is to build a health center platform (the building is already there) that allows the booking of sport programmes (pilates, kangoo jumps), from here referred to simply as programmes. The main difference from her competitors is that she wants to make them accessible through other applications that already have a user base, such as maybe Facebook, Strava, Suunto or any custom application that wants to encourage their users to practice sport. This means they need to be able to integrate our client’s product into their own.
The team has decided that the best solution would be a REST API that could be integrated by those other platforms and that the application does not need a dedicated frontend (no html, css, yeeey!). After an initial discussion with the client, you know that the main responsibility of the API is to allow users to register to an existing programme and allow admins to create and delete programmes.
When creating programmes, admins need to provide a time interval (starting date and time and ending date and time), a maximum number of allowed participants (users that have registered to the programme) and a room in which the programme will take place.
Programmes need to be assigned a room within the health center. Each room can facilitate one or more programme types. The list of rooms and programme types can be fixed, with no possibility to add rooms or new types in the system. The api does not need to support CRUD operations on them.
All the programmes in the health center need to fully fit inside the daily schedule. This means that the same room cannot be used at the same time for separate programmes (a.k.a two programmes cannot use the same room at the same time). Also the same user cannot register to more than one programme in the same time interval (if kangoo jumps takes place from 10 to 12, she cannot participate in pilates from 11 to 13) even if the programmes are in different rooms. You also need to make sure that a user does not register to programmes that exceed the number of allowed maximum users.
Authentication is not an issue. It’s not required for users, as they can be registered into the system only with the (valid!) CNP. A list of admins can be hardcoded in the system and each can have a random string token that they would need to send as a request header in order for the application to know that specific request was made by an admin and the api was not abused by a bad actor. (for the purpose of this exercise, we won’t focus on security, but be aware this is a bad solution, do not try in production!)
You have estimated it takes 4 weeks to build this solution. You have 2 days. Good luck!*

## Technical documentation
### Data and Domain model
A full list of entities used in my project: https://docs.google.com/document/d/1JPGmd6FMSLgWUS3LWyC9vdJQPocMWLvk5RAGgsx0Zi4/edit?usp=sharing

####The Admin 
Admin entity is the representation of Admin actor. Admin must be able to create, delete and update programmes. An important thing about the admin is that it has a token stored in the database that allows us to make operations on programmes.

####User
User entity is the client that will be able to subscribe to programmes. User has a CNP field, cnp is here to replace the registration forms. So on creation my program checks for CNP validation that will make sure the user has valid data in his account.

####Programme Type
Programme Type is the entity that will separate preogrammes by type.

####Room
Room is the entity that stores information about the rooms, so we can use separate rooms for different programmes.

####Programme
Programme is the event created by an admin. Programme has a OneToOne relation with programme_type and room, because one event can happen in one room and it can hold just one programme_type action.
Another relation that it contains is a ManyToMany relation with Users, because many users can subscribe for many events.

### Application architecture
My design contains several key feratures. I decided to use the MVC design pattern, thus the REST API applications contains controllers and services that do all the work.
For my relation with database I chose to use the Data Mapper pattern, thus every service has acces to a repository manager.
In order to work along with SOLID principles I decided to separate every key CRUD operation to separate controllers, basicly mapping every REST operation on any entity to it's controller assigned to that specific operation. 
I used for complex entities like Programme and for user I used Factory pattern to build the objects from data received from Requests.
###  Implementation
##### Functionalities
For each of the following functionalities, please tick the box if you implemented it and describe its input and output in your application:

[x] Brew coffee \
[X] Create programme \ 
[X] Delete programme \
[X] Book a programme 

####Brew Coffe
Input: black coffe + milk

####Create programme
Json input: roomID, programmeTypeID, startData in a ISO DateTime format, maxParticipants and endData in a ISO DateTime.

####Delete programme
Input: request parameter equal to the ID of the programme that needs to be deleted.

####Book a programme
Input: request parameter = id of the programme and JsonInput for the ID of the user that wants to sign in for the programme.

##### Business rules
CNP validator : done
Before creation of users check if the user is laready in the database : not yet
Token validation -> check if token is in the database : not yet
On User booking a programme a mechanism that will check if the room is not full : done

##### 3rd party libraries (if applicable)
symfony/orm-pack & --dev symfony/maker-bundle used for easier work with database. In my specific project I used annotations for creating relations between tables. Also used the doctrine to make migrations.
symfony/serializer - for object serialization to send and receive custom responses that would contain objects.


##### Environment
Please fill in the following table with the technologies you used in order to work at your application. Feel free to add more rows if you want us to know about anything else you used.
| Name | Choice |
| ------ | ------ |
| Operating system (OS) | Windows 10 |
| Database  | MySQL 8.0.3 |
| Web server| Symfony integrated server |
| PHP | e.g. 8.0.3 |
| IDE | e.g. PhpStorm |

### Testing
Manual testing only. Did not have enough time to implent automated testing

## Feedback
In this section, please let us know what is your opinion about this experience and how we can improve it:

1. Have you ever been involved in a similar experience? If so, how was this one different?
2. Do you think this type of selection process is suitable for you?
3. What's your opinion about the complexity of the requirements?
4. What did you enjoy the most?
5. What was the most challenging part of this anti hackathon?
6. Do you think the time limit was suitable for the requirements?
7. Did you find the resources you were sent on your email useful?
8. Is there anything you would like to improve to your current implementation?
9. What would you change regarding this anti hackathon?

