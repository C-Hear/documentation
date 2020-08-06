## Square Space integration example

This will help you start embedding CHIF files into a Square Space site.

## 1.General Reference Docs:

https://support.squarespace.com/hc/en-us/articles/205815908

## 2. Place A CHIF in Square Space:

Create a site and enter the editor:

![add code](sq1.png)

Once your in the editor:

![add code](sq2.png)

Navigate to settings/advanced/code injection:

![add code](sq3.png)

place the script below inside the header.

```html
<script type="text/javascript" src="https://storage.googleapis.com/chif-player/chifPlayer-[version].js"></script>
```

Place script after the body tag:

```html
<script>
	(async function () {
		const chifResults = await chifPlayer.streamFiles();
	})();
</script>
```

Save the changes.

Click Edit to edit the page and click the add button:

![add code](sq4.png)

Add a code block to the page:

![add code](sq5.png)

Place the chear tag inside the body as html:

```html
<chear src="CHIF URL" /></div>
```

![add code](sq6.png)

Apply and save the file.

In the `<script>` tag above, replace `[version]` with the version number of the player in use.

In the `<chear>` tag above, replace `src="CHIF URL"` with the path to your CHIF File.