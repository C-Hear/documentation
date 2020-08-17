## Square Space integration example

This will help you start embedding CHIF files into a Square Space site.

## 1.General Reference Docs:

https://support.squarespace.com/hc/en-us/articles/205815908

## 2. Place A CHIF in Square Space:

Create a site and enter the editor:

![add code](imgs/sq1.png)

Once your in the editor:

![add code](imgs/sq2.png)

Navigate to settings/advanced/code injection:

![add code](imgs/sq3.png)

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

![add code](imgs/sq4.png)

Add a code block to the page:

![add code](imgs/sq5.png)

Place the chear tag inside the body as html:

```html
<chear src="[chif url]" /></div>
```

![add code](imgs/sq6.png)

Apply and save the file.

In the `<script>` tag above, replace `[version]` with the version number of the player in use.

* [Player Version Link/General Implementation](../../player/playerimplementation.md)

In the `<chear>` tag above, replace `src="[chif url]"` with the path to your CHIF File.