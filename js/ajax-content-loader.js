// based on http://www.webdesign-podcast.de/2011/03/23/wordpress-artikel-via-ajax-nachladen-wie-auf-facebook-tutorial/ */

// Iterations-Hilfs-Variable, zählt wie oft nachgeladen wurde
var actPage = 0;
// Der Button wird mit der Klick-Funktion zum nachladen belegt
jQuery('#ajaxcontentloader a').bind('click', function(){ 
        // Wenn der Button noch nicht im Lade-Modus ist, werden die weiteren Anweisungen ausgeführt
	if(jQuery('#ajaxcontentloader a').attr('class') != 'loading'){
                // Dem Button wird die Klasse 'loading hinzugefügt' (css: halbtransparent)
		jQuery('#ajaxcontentloader a').addClass('loading');
                // Iterations-Hilfs-Variable hochzählen
		actPage++;
			// Linkziel für die nächste Seite auslesen
		var toGet = jQuery('#ajaxcontentloader a').attr('href');
            // jQuery GET Request zum auslesen der nächsten Seite mit Callback-Funktion
   		jQuery.get(toGet, function(data, success) {
			// Wenn der GET Request erfolgreich ausgeführt wurde...
			if(success=='success'){
				// Wird der neue Content aus der via AJAX geladenen Seite aus dem Container #content geladen
				newContent = jQuery('#content', data).html();
				// das neue Linkziel für die nächste Seite wird ausgelesen
				toGet = jQuery('#ajaxcontentloader a', data).attr('href');
				// das neue Linkziel für die nächste Seite wird eingetragen
				jQuery('#ajaxcontentloader a').attr('href', toGet);
				// der Content wird in ein div mit laufender Nummer (Iterations-Hilfs-Variable) gepackt und vor den Mehr-Laden-Button gehängt
				jQuery('<div class="ajaxloaded'+actPage+'">'+newContent).insertBefore('#ajaxcontentloader');
				// nur fürs Auge: erst ausblenden, dann langsam einfaden
				jQuery('.ajaxloaded'+actPage).css('display', 'none');
				jQuery('.ajaxloaded'+actPage).fadeIn('slow');
				// Der Lade-Zustand des Buttons wird wieder entfernt
				jQuery('#ajaxcontentloader a').removeClass('loading');
				// Wenn es keine neue Seite mehr gibt, Button entfernen
				if (toGet == undefined) {
					jQuery('#ajaxcontentloader a').remove();
				}
			}
		});
	}
        // Um zu verhindern das bei klick auf den Button die href URL aufgerufen wird
        // brechen wir den Linkaufruf mit return false ab
	return false;
});