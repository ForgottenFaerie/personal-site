<h1 align="center"> <a href="www.nonbinarybyte.com">www.nonbinarybyte.com</a> </h1>

Welcome to my magical land, that is *my website*. I'm glad you are looking at the src for this website even if youre just gonna take it and run. but let me tell you how to use this first!

<h2 align="center">How to use!</h2>

1. get a local server (easy with this VS Code extension + XAMMP)
    
    1.1. [XAMMP](https://www.apachefriends.org/download.html)

    1.2. [VS Code extension](https://marketplace.visualstudio.com/items?itemName=yandeu.five-server)

    1.3. config file
    ```javascript
    // fiveserver.config.js
    module.exports = {
    // Configuration settings for FiveServer.
        php: "/usr/bin/php", // linux/mac 
        // change for windows.
    }
    ```

2. get a production server. I use [wasmer.io](https://wasmer.io/) because its free!
3. ***edit the code to your liking, please do NOT just copy!***
4. Get a domain!
5. push to production (*after securing & testing!*)

<h2 align="center">Keep these files!</h2>

- `.gitignore`
- `fiveserver.config.js`
- `.env` (keep private.)
- `hash-script.php` (to hash admin passwords!)
- `/src` this contains all source code **KEEP IT**