document.addEventListener("DOMContentLoaded", function(){
	let chifPlayer = window.chifPlayer;

	(async function () {
		const chifResults = await chifPlayer.streamFiles();
	})();
});	