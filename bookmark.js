function browser_bookmark () {
	window.sidebar.addPanel(document.title, location,"");
	window.external.AddFavorite(location, document.title);
}
// by JulianWP UGM 2009 Yogyakarta