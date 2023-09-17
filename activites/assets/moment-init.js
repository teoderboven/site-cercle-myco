/**
 * Checks if a moment is today
 * @param {moment} momnt the moment to check
 * @return {boolean} true if the moment is today, false else 
 */
function isToday(momnt){
	if(!(moment.isMoment(momnt))) return false;

	return momnt.isSame(moment(), 'day');
}
/**
 * Checks if a moment is tomorrow
 * @param {moment} momnt the moment to check
 * @return {boolean} true if the moment is tomorrow, false else 
 */
function isTomorrow(momnt){
	return isToday(moment(momnt).subtract(1, 'day'));
}
moment.locale('fr', {
	months : 'janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre'.split('_'),
	monthsShort : 'janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.'.split('_'),
	monthsParseExact : true,
	weekdays : 'dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi'.split('_'),
	weekdaysShort : 'dim._lun._mar._mer._jeu._ven._sam.'.split('_'),
	weekdaysMin : 'Di_Lu_Ma_Me_Je_Ve_Sa'.split('_'),
	weekdaysParseExact : true,
	longDateFormat : {
		LT : 'HH:mm',
		LTS : 'HH:mm:ss',
		L : 'DD/MM/YYYY',
		LL : 'D MMMM YYYY',
		LLL : 'D MMMM YYYY HH:mm',
		LLLL : 'dddd D MMMM YYYY HH:mm'
	}
});