== What Is the Flex Ajax Bridge? ==

The Flex Ajax Bridge (FABridge) is a small, unobtrusive library of code that you can insert into a Flex application, a Flex component, or even an empty SWF file to expose it to scripting in the browser. 

To humbly borrow a page from the Ruby on Rails community, FABridge is built with the “don’t repeat yourself” principle in mind. Rather than having to define new, simplified APIs to expose a graph of ActionScript objects to JavaScript, with FABridge you can make your ActionScript classes available to JavaScript without any additional coding. Once you’ve inserted the library, pretty much anything you can do using ActionScript, you can do using JavaScript.

Flash Player has the ability natively, through the External API (the ExternalInterface class), to call JavaScript from ActionScript and vice versa.  But ExternalInterface has some limitations:
* The ExternalInterface class requires you, the developer, to write a library of extra code in both ActionScript and JavaScript, to expose the functionality of your Flex application to JavaScript, and vice versa.  
* The ExternalInterface class also limits what you can pass across the gap – primitive types, arrays, and simple objects are legal, but user-defined classes, with associated properties and methods, are off-limits.  You’re limited in what you can do. 
* The ExternalInterface class enables you to define an interface so your JavaScript can call your ActionScript – FABridge essentially lets you write JavaScript instead of ActionScript.


== Where Should I Use the Flex Ajax Bridge? ==

You may find the FABridge library useful if you:
* Want to use a rich Flex component in an Ajax application but don’t want to write a lot of Flex code. If you wrap the component in a bridge-enabled stub application, you can script it entirely from JavaScript – including using eval()’d JavaScript generated remotely by the server.
* Only have one or two people on your team who know Flex.  While I would strongly encourage everyone to grab a copy of Flex and try it out (you’ll love it, I promise!), the FABridge library allows everyone on your team to use the work produced by one or two Flex specialists.
* Are building an integrated RIA with both Flex and Ajax portions.  While you could build the integration yourself using ExternalInterface, you might find it faster to start with FABridge as a head start.


== What Do I Need to Use It? ==

To use the FABridge library and samples, you must have the following:
* Flex Builder 2.0 Beta 3
* Flash Player 9 Beta 3
* Internet Explorer or Firefox, with JavaScript enabled
* Any HTTP server to run the samples


== Installation ==

To run the sample files, follow these steps:

# Download and unpack the ZIP file to a local directory
# Place the ''src'' and ''samples'' folders side by side on any HTTP server. 
# Open a web browser to <your web server>/samples/FABridgeSample.html and samples/SimpleSample.html and follow the instructions there.
# Make sure to access the samples via <nowiki>http://</nowiki> urls and not <nowiki>file://</nowiki> URLs. The Flash Player security sandbox may prevent them from working correctly if accessed as local files.


== I’ve Run the Samples. How Do I Use the Flex Ajax Bridge? ==

To use the FABridge library in your own Flex and Ajax applications, follow these steps:
# Add the ''src'' folder from the ZIP file to the ActionScript <code>classpath</code> of your Flex application
## In Flex Builder, right click your application in the Navigator window and choose Properties.
## Select the Flex Build Path section.
## Add the ''src'' folder to the class path section. Click OK.
## If you’re compiling from the command line, you can add the ''src'' folder to your application by specifying it using the --actionscript-classpath compiler option.
# Add the following tag to your application file:

  <mx:Application …>
    <fab:FABridge xmlns:fab="bridge.*" />
    ...

To access your application instance from JavaScript, try this:

  function useBridge() 
  {
      var flexApp = FABridge.flash.root();
  }

To get the value of a property, call it like a function. Use the same syntax to access objects by id:

  function getMaxPrice() 
  {
      var flexApp = FABridge.flash.root();
      var appWidth = flexApp.width();
      var maxPrice = flexApp.maxPriceSlider().value();
  }

To set the value of a property from JavaScript, call the function <code>setPropertyName()</code>:

  function setMaxPrice(newMaxPrice) 
  {
      var flexApp = FABridge.flash.root();
      flexApp.maxPriceSlider().setValue(newMaxPrice);
  }

You can call object methods directly just as you would from ActionScript:

  function setMaxPrice(newMaxPrice) 
  {
      var flexApp = FABridge.flash.root();
      flexApp.shoppingCart().addItem(“Antique Figurine”, 12.99 );
  }

You can pass functions, such as event handlers, from JavaScript to ActionScript as well:

  function listenToMaxPrice() 
  {
      var flexApp = FABridge.flash.root();
      var maxPriceCallback = function(event)
      {
          document.maxPrice = event.newValue();
          document.loadFilteredProducts(document.minPrice, document.maxPrice);
      }
      flexApp.maxPriceSlider().addEventListener(“change”, maxPriceCallback );
  }

To run initialization code on a Flex file, you need to wait for it to download and initialize first.  Register a callback to be invoked when the movie is initialized, like so:

  function initMaxPrice(maxPrice)
  {
      var initCallback = function()
      {
          var flexApp = FABridge.flash.root();
          flexApp.maxPriceSlider.setValue(maxPrice);
      }
      FABridge.addInitializationCallback("flash",initCallback);
  } 

To script multiple Flash movies on the same page, give them unique bridge names through the flashVars mechanism.  Use the bridge name to access them from the bridge, and to register for initialization callbacks:

  <object ...>
    <param name='flashvars' value='bridgeName=shoppingPanel'/>
    <param name='src' value='app.swf'/>
    <embed ... flashvars='bridgeName=shoppingPanel'/>
  </object>
  
  function initMaxPrice(maxPrice)
  {
      var initCallback = function()
      {
          var flexApp = FABridge.shoppingPanel.root();
          flexApp.maxPriceSlider.setValue(maxPrice);
      }
      FABridge.addInitializationCallback("shoppingPanel",initCallback);
  }

== What are the Limitations? ==


The FABridge library is currently in a pre-alpha state. It has been tested to a limited degree on Firefox 1.5 and Internet Explorer 6.0 (SP2).  It has not to date been tested on any Linux or Macintosh browsers.

Because of the limited integration between the JavaScript and ActionScript garbage collection models, the bridge must guarantee that any ActionScript object stays in memory indefinitely once it has been accessed from JavaScript.  If you find that memory consumption is becoming an issue in your use of the bridge, you can call the function <code>FABridge.<flash | bridge name>.releaseASObjects()</code>. This will clear the cache of bridged objects and functions and allow them to exit from memory as appropriate.  After calling this function, all references to ActionScript objects and functions are invalid and must be reacquired.

In future releases of the FABridge library, we expect to add some slightly more specialized handling of objects based on type and time of access to make calling this function unnecessary (i.e., future releases will not cache event objects outside the lifetime of the event callback).

For performance reasons, when an anonymous object is sent from ActionScript to JavaScript, the bridge assumes it contains only primitives, arrays, and other anonymous objects – and no strongly typed objects or methods.   Instances or methods sent as part of an anonymous object will not be bridged correctly.


== How Do I Find out More? ==

Post any questions or feedback on the Flex Ajax Bridge to the [http://labs.macromedia.com/community/ forums] available on the Adobe Labs site.

== Summary ==

You can use the FABridge library to automatically expose your Flex application to Ajax-based HTML applications.  Using the bridge, you can easily embed rich Flex components in your applications, integrating the tightly with the rest of the page content.  Once a Flex application is enabled through the bridge, JavaScript developers have access to all of the functionality it provides.
