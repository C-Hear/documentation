## Blogger integration example

This will help you start embedding CHIF files into a Blogger site.

## 1. Place A CHIF in Blogger:

Naviage to theme and select the triple dot button and select edit html:

![add code](blog1.png)

place the script below inside the header.

```html
<script type="text/javascript" src="https://storage.cloud.google.com/chif-player/chifPlayer-[version].js"></script>
```

![add code](blog2.png)

place script after the body tag:

```html
<script>
	(async function(){const chifResults = await chifPlayer.streamFiles({selector: '.chif_file';})})()
</script>
```

![add code](blog3.png)

Save the file.

Enter the layout page and select add a gadget:

![add code](blog4.png)

Select the HTML/Javascript gadget:

![add code](blog5.png)

Place the following div tag:

```html
<div class="chif_file" src="CHIF URL"></div>
```

![add code](blog6.png)

Select View your blog:

![add code](blog7.png)

In the `<script>` tag above, replace `[version]` with the version number of the player in use.

In the `<chear>` tag above, replace `src="CHIF URL"` with the path to your CHIF File.
