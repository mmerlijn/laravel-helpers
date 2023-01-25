export default () => ({
    flashes: [],
    visible: [],
    add(flash) {
        flash.id = Date.now()
        this.flashes.push(flash)
        this.fire(flash.id)
    },
    fire(id) {
        this.visible.push(this.flashes.find(flash => flash.id == id))
        const timeShown = 4000 * this.visible.length
        setTimeout(() => {
            this.remove(id)
        }, timeShown)
    },
    remove(id) {
        const flash = this.visible.find(flash => flash.id == id)
        const index = this.visible.indexOf(flash)
        this.visible.splice(index, 1)
    },
})
/*
* Install:
// ### add in app.js
import flashHandler from './flashHandler'
window.flash = msg => window.dispatchEvent(new CustomEvent('flash', {detail: msg}))
Alpine.data('flashHandler', flashHandler)

// ### Add flash component

// ### add in layout at the bottom
<x-flash/>
@stack('scripts')
</body>
*
* usage
* <button x-data={} @click="$dispatch('flash',{text:'',type:'success'})">klik me</button>
*
* or flash({text:'hi'})
*
* */
