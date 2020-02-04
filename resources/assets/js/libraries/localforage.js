import localforage from 'localforage'

localforage.config({
	driver: localforage.LOCALSTORAGE,
	name: 'Realtime',
	storename: 'keyvaluepairs'
})

export default localforage