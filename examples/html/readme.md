## HTML integration example

Following is a simple example to get started using CHIF in your web site with only a small amount of HTML and JavaScript.

#### `index.html`

```html
<html>
  <head>
    <script src="https://storage.cloud.google.com/chif-player/chifPlayer-[version].js"></script>
  </head>
  <body>
    <chear src="[chif url]" />
  </body>
  <script>
      (async function() {
        const chifResults = await chifPlayer.streamFiles()
      })()
  </script>
</html>
```

In the `<script>` tag above, replace `[version]` with the version number of the player in use.

* [Player Version Link/General Implementation](../../player/playerimplementation.md)

In the `<chear>` tag above, replace `src="[chif url]"` with the path to your CHIF File.
