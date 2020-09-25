# Project GroupStudy
A Web App to ease collaboration among groups of people, especially useful for students looking for a medium other than typical social media platforms to keep connected. Easy interaction, file sharing and chat features make the app a all-in-one for keeping up-to-date with group members.

Features include:
- Users create an account, and can create groups.
- Users are part of one or more groups. Each group has a landing page where they can interact.
- Group members with a groups admin password can invite other registered members.
- They can post, comment on posts, engage in chat.
- Groups have a fie storage system to store files organized in folders.
- Set tag to uploaded. Search files by tag or filename or filetype. 
- See notifications both inside and outside of group.
- A shared white-board app is accessible to each group. 

This app was built with a PHP backend and pure HTML, CSS, JS based front-end. 

## Run Project

### Server
- Install XAMPP.
- Open and run Apache and MySQL by `sudo ./opt/lampp/manager-linux-x64.run`. Start Apache and MySQL.
- In `xampp/htdocs/` clone this repository.
### Database
- Open `localhost/phpmyadmin` in browser and create a database called `groupstudy`.
- Go to `Import`, click `choose file` and select the `setting files/groupstudy.sql` file. Click `Go`. The database should be set up. Some dummy data fills the database, if you want you can clear all the tables.
- [optional] In `user` table, facebook, linkedin, github columns need to be set to have default as NULL.
- Run `SET @@global.sql_mode= '';`
### Set file path
- If you are not running from linux, in `GroupStudy/generatecaptcha.php` change the path towards the end of the file to the proper location of the GroupStudy folder.
- Similarly in two places in `register.php`, on place in `deletepost.php`, `addpost.php`, and `profile_setting.php`.

### Send mail
Application will work fine without these settings, just emails wont be sent.
- [Windows](https://stackoverflow.com/questions/15965376/how-to-configure-xampp-to-send-mail-from-localhost/18185233#18185233)
- [Linux](https://stackoverflow.com/questions/33969783/phpubuntu-send-email-using-gmail-form-localhost/45125490#45125490)
- Have to turn on access to less secure apps `ON` in gmail. Turn it off later if you want.
### Run
- Run `localhost/GroupStudy/main_page.php` from browser and Enjoy!

## Project Files

- MAIN PAGE
    - main_page.php (connect.inc.php, core.inc.php)
    - mainjs.js
- LOGIN
    - login.php
    - login_form.php
    - login.css (backL.jpg)
- REGISTER
    - register.php
    - register_form.php
    - register.css (generatecaptcha.php, font.ttf, backR.jpg)
    - registered.html
    - registered.css
- LOGGED IN
    - loggedin.php
    - loggedin_form.php
    - loggedin.css
    - loggedin.js
    - search_img.png
    - grouplist.php
- GROUP
    - setsession.php
    - grouppage.php
    - grouppage.html
    - grouppage.css
    - grouppage.js
- GROUP FEATURES
    - addpost.php
    - addfolder.php
    - searchfiles.php
    - deletepost.php
    - addcomment.php
    - deletecomment.php
    - deletefolder.php
    - https://www.twiddla.com/API/Reference.aspx
    - {board.php,board.html=> not in use, were trialed with}
- USER SETTINGS
    - logout.php
    - deletenotif.php
    - profil_setting.php
    - profile_setting_form.php
    - profile_setting.css
    - profile.php
    - profile_form.php
    - profile.css

- CHAT FEATURE
    - insert_chat.php
    - chat_log.php
    - offline.php
    - toggleoffline.php
    - namelist.php //to update showing online or offline
- GROUP SETTINGS
    - group_setting.php
    - group_setting.html
    - group_setting.css
    - remove_user.php
    - timeout.html
    - timeout.js
- INVITE TO GROUP
    - invite.php
    - invite.html
    - invite.css
    - invite.js
    - send_invite.php
    - userlist.php//list of users not in group
    - deleteinvite.php
    - add_to_grp.php