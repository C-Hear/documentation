# CHIF Player <!-- omit in toc -->

- [Overview](#overview)
- [Components](#components)
  - [CHIF object](#chif-object)
  - [Web streamer](#web-streamer)
  - [Web player](#web-player)
- [Isomorphic API](#isomorphic-api)
  - [CHIFFile](#chiffile)
    - [`async init (chunk, options)`](#async-init-chunk-options)
    - [`writeChunk (data)`](#writechunk-data)
    - [`getPart (name)`](#getpart-name)
  - [CHIFPart](#chifpart)
- [Browser API](#browser-api)
  - [chifPlayer](#chifplayer)
    - [`async streamFiles (options)`](#async-streamfiles-options)
    - [`async streamFile (url, options)`](#async-streamfile-url-options)

## Overview

The CHIF player is a JavaScript package that can be easily included to any web site or application.

In its simplest form, the player can be used by calling the exported function streamFiles(), as shown in the following code block which uses our CDN.

```html
<html>
  <head>
    <script src="https://storage.cloud.google.com/chif-player/chifPlayer-3.0.0.js"></script>
  </head>
  <body>
    <chear src="example1.chif" />
    <script>
      (async function() {
        const chifResults = await chifPlayer.streamFiles()
      })()
    </script>
  </body>
</html>
```

## Components

The player package contains the following 3 primary components that interact with each other for simple or advanced use cases requiring more customization.

* A **CHIF object** provides decoded binary files and data from CHIF files
* The **Web streamer** creates CHIF objects from URLs
* The **Web player** displays and plays binary files from CHIF objects

### CHIF object

The CHIF object is an instance of the CHIFFile class, which decodes a CHIF data stream into its component parts, such as binary image and audio files and key-value data. 

### Web streamer

The web streamer is built on top of modern browsers' [Streams](https://developer.mozilla.org/en-US/docs/Web/API/Streams_API) and [Fetch](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API) APIs to retrieve CHIF files from remote servers  using JavaScript. Therefore, if paths to CHIFs on other domains from the hosting page are required, the [same-origin policy](https://developer.mozilla.org/en-US/docs/Web/Security/Same-origin_policy) applies and the web host must support [CORS](https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS) or the CHIF will not be streamed.

### Web player

The web player is an optional set of DOM elements which are created during streaming that interact with 1 or more parts of a CHIF file for presentation in the user's browser.

The web player contained in the package contains interactive controls to display preview images, play and pause audio streams, and show and hide key-value data.  The web player is used by default when calling streamFiles(), for example, but this can be overridden using options as documented below.

## Isomorphic API

### CHIFFile

The CHIFFile is an in-memory version of a streamed CHIF file for decoding and custom integrations. This class can be used in either the browser or included in alternative hosting environments using Node.js.

All functions are documented below for completeness, but typical integrations will only use `getPart()` in order to access binary contents, as the web streamer included in this package takes care of the loading functions `init()` and `writeChunk()`.

```js
{
    async init (chunk, options)
    writeChunk (chunk)
    getPart (name)    
}
```

#### `async init (chunk, options)`

Prepares a CHIF file for streaming and applies any load-time validations and DRM.

**Arguments**

* chunk, Uint8Array
* options, object

**chunk**: The first chunk of a streamed CHIF file containing the entire header preamble. If the header is larger than the chunk, decoding will fail.

**options**: Advanced options for loading and streaming CHIF files. The following is a listing of all supported options and default values.

```js
{
  verify: true,
  write: true
}
```

* **verify**: If loading should include an API call to verify if the CHIF is allowed to be viewed.

* **write**: If the chunk passed in should also be written to the CHIFFile internal structure.  This should typically be `true`, but it can be disabled if only pre-flight validation is needed.

#### `writeChunk (data)`

Writes binary data incrementally into the CHIF in-memory data structure for decoding and reassembly.

The following is simplistic example of how to use `init()` along with  `writeChunk()` to load a CHIFFile from a stream of binary data.

```js
const chif = new CHIFFile()

const firstChunk = await getChunk()

await chif.init(firstChunk)

while (true) {
  const chunk = await getChunk()

  if (!chunk) {
    break
  }

  chif.writeChunk(chunk)
}
```

#### `getPart (name)`

Retrieves the [CHIFPart](#chifpart) object by name.

The following is an example of displaying an image in the browser DOM with  `getPart()`.

```js
const imgResponse = new Response(chif.getPart('image1').data)
const imgBlob = await imgResponse.blob()

const imgEl = document.createElement('img')
imgEl.src = URL.createObjectURL(imgBlob)
```

### CHIFPart

Named component within a CHIFFile object.  This usually represents a file and provides the Uint8Array binary data for consumption and integration.

```js
{
  name,     // string
  format,   // string
  size,     // int
  data,     // Uint8Array
}
```

## Browser API

### chifPlayer

When the player package is included in a web site or application, it adds a new object into the global window named `chifPlayer`. The following functions can be used for streaming a single CHIF programmatically or using a DOM selector to discover and stream CHIFs from elements on the page.

#### `async streamFiles (options)`

The options argument is not required, but if used, contains both DOM selector overrides and DOM interaction callbacks.

```js
{
  selector = 'chear',
  attribute = 'src',
  preview = true,
  previewHandler = onPreview,
  playerHandler = onStream,
  blockedHandler = onBlock
}
```

For example, the above options would discover and stream all chear tags in the DOM with a src attribute, such as the intro example at the top of this page. If a managed hosting environment such as a CMS or other web-based system doesn't support custom elements, you can change the selector and attribute to use a more widely supported markup, such as the following example that uses class selectors.


```html
<span class="chif_file" data-url="example1.chif"></span>
```

```js
const options = {
  selector: '.chif_file',
  attribute: 'data-url'
}

const chifResults = await chifPlayer.streamFiles(options)
```


The handler functions can be used to override the default DOM integrations with custom implementations. The following show the definitions of each one.

```js
async function onPreview (chif, url, el, wrapper) {}
async function onStream (chif, el, wrapper) {}
async function onBlock (message, el, wrapper) {}
```

`streamFiles()` resolves an array of objects with the properties shown below. 

```js
[
  {
    el,  // HTMLElement: element that contains a UI control
    url, // string: URL of streamed CHIF
    chif // CHIFFile
  }
]
```

#### `async streamFile (url, options)`

The options argument is not required, but if used, contains DOM integration and DOM interaction callbacks.

```js
{
  el,
  wrapper,
  preview = true,
  previewHandler = onPreview,
  playerHandler = onStream,
  blockedHandler = onBlock
}
```

`streamFile()` resolves an object with the properties shown below. 

```js
{
  wrapper, // HTMLElement: element that contains a UI control
  chif     // CHIFFile
}
```

