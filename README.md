ApiTestCase
===========

<b>Тестовое задание</b>

Subject: Create an API which allow users and groups management
Out of scope: authentication, and roles management; forms and views

<b>User Stories:</b>
- I want to create a user who is included in a group
- I want to check if this user exits and is active
- I want to modify the list of users of a group
<b>Entities:</b>
- User: email, last name, first name, state (active/ non active), creation date
- Group: name
<b>API methods:</b>
- /users/ fetch(retrieve) list of users
- /users/ create a user
- /users/id/ fetch info of a user
- /users/id/modify users info
- /groups/ fetch list of groups
- /groups/create a group
/groups/id/modify group info
<b>Bonus:</b>
- to perform a functional test
- add validation constraints/rules
