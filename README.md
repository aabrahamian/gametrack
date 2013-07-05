GameTrack Proof of Concepts REST App
====================================

This is a proof of concepts REST app for me to test out RESTful services using the Silex framework
 * Silex: https://github.com/fabpot/Silex
I also have been looking into JSON hyperschema and have added the quick start bundle in my project so that I can make sure that the links I have been creating for my services work like I expect them to.
 * Json Hyperschema: http://json-schema.org/documentation.html
 * JSONary: http://jsonary.com
Note that this code needs to be refactored. I just needed to test out some concepts really quick so I got the bare minimum working with the idea to come back later to fix it.

CURRENT TODO
============
* Add hyperschemas for all types (Company, Game, and Gamesession are missing right now)
* Add create and delete methods/functions for all types
* Refactor controllers to better utilize the strengths of Silex
* Error Handling (there is no 400 errors currently)
