# APIPlugin

simulation of oauth protocol in elgg1.11 


simulation of oauth protocol ,  to increase security in relation to the access to elgg site via Web Services is written.
in fact, there are  APIPlugins for access to elgg site via Web Services!
in fact,these plugins are the performance simulation of oauth protocol in elgg1.11 .

you can register and access applications with using these Plugins .
To do this, you should take the following steps



1)Register applications
for register application:you must enter your application name  in userAPI plugin and generate public and private keys and save in DB. for example, some APIPlugins are developed for use userAPI plugin.
description of plugins is  :

userAPI:Plugin for register application
FriendAPI: show user's friends(show friend application)
MembersAPI:show site members(showmembers application)
twoapp2:two applications (showblogs and addblog applications)
app2:one application for show blog and add blog(app2 application)
adduserAPI:add user with admin(adduser application)
 
2)using APIPlugins
after register applications,These plug-ins on path: usersettings / configure your tools / PluginName from site are available to the user .

if want to access application facilities,you must go to page of plugins from above path,then generate  secret and token and authorize.



LoginAPI Plugin:login and enter application name for  get keys(token and secret,public and private ) as json
in LoginAPI Plugin,user must login and enter  application name.then  ,if application is exist ,recieve keys for access to application via Web Servicess.
library functions and messages   show results as php and json For use in access via Web Servicess
