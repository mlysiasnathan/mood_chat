
class Caroussel{
    constructor (element, options = {}) {
        this.element = element
        this.options = Object.assign({}, {
            slideToScroll: 1,
            slidesVisibles: 1,
            loop: false,
            animated: false,
            navigation: false,
            pagination: false,
            infinite: false
        }, options)
        this.isMobile = true
        this.isTab = true
        this.currentItem = 0
        this.moveCallBacks = []
        this.offset = 0
        if (this.options.loop && this.options.infinite) {
            // throw new Error("Caroussel can't be in loop and in infinite at the same time")
            console.error("Caroussel can't be in loop and in infinite at the same time", element)
        }
        // DOM modification========================================================
        let children = [].slice.call(element.children)
        this.root = this.createDivWithClass('carousselRow')
        this.root.setAttribute('tabindex', '0')
        this.container = this.createDivWithClass('carousselContainer')
        this.root.appendChild(this.container)
        this.element.appendChild(this.root)
        this.items = children.map((child) => {
            let item = this.createDivWithClass('carousselItem')
            item.appendChild(child)
            return item
        });
        this.setStyle()
        if (this.options.navigation) {
            this.createNavigation()
        }
        if (this.options.pagination) {
            this.createPagination()
        }
        if (this.options.infinite) {
            this.offset = this.options.slidesVisibles + this.options.slideToScroll
            if (this.offset > children.length) {
                console.error("Not enought element in to the Caroussel", element)
            }
            this.items = [
                ...this.items.slice(this.items.length - this.offset).map(item => item.cloneNode(true)),
                ...this.items,
                ...this.items.slice(0, this.offset).map(item => item.cloneNode(true)),
            ]
            this.gotoItem(this.offset, false)
        }
        this.items.forEach(item => this.container.appendChild(item))
        
        // event===================================================================
        this.moveCallBacks.forEach(cb => cb(this.currentItem))
        this.onWindowResize()
        window.addEventListener('resize', this.onWindowResize.bind(this))
        this.root.addEventListener('keyup', e => {
            if (e.key === 'ArrowRight' || e.key === 'Right') {
                this.next()
            } else if (e.key === 'ArrowLeft' || e.key === 'Left'){
                this.prev()
            }
        })
        if(this.options.animated){
            setInterval(this.next.bind(this), 3000)
        }
        if (this.options.infinite) {
            this.container.addEventListener('transitionend', this.resetInfinite.bind(this))
        }
    }
    createDivWithClass(className){
        let div = document.createElement('div')
        div.setAttribute('class', className)
        return div
    }
    setStyle(){
        let ratio = this.items.length / this.slidesVisibles
        this.container.style.width = (ratio * 100) + '%'
        this.items.forEach(item => item.style.width = ((100 / this.slidesVisibles) / ratio ) + '%');
    }
    createNavigation(){
        let nextBtn = document.querySelector('.nextBtn')
        let prevBtn = document.querySelector('.prevBtn')
        // this.root.appendChild(prevBtn)
        // this.root.appendChild(nextBtn)
        prevBtn.addEventListener('click', this.prev.bind(this))
        nextBtn.addEventListener('click', this.next.bind(this))
        if (this.options.loop === true) {
            return
        }
        this.onMove(index => {
            if (index == 0) {
                prevBtn.classList.add('d-none')
            } else {
                prevBtn.classList.remove('d-none')
            }
            if (this.items[this.currentItem + this.slidesVisibles] === undefined) {
                nextBtn.classList.add('d-none')
            } else {
                nextBtn.classList.remove('d-none')
            }
        })
    }
    next(){
        this.gotoItem(this.currentItem + this.slideToScroll)
    }
    prev(){
        this.gotoItem(this.currentItem - this.slideToScroll)
    }
    gotoItem(index, animation = true){
        if (index < 0) {
            if (this.options.loop) {
                index = this.items.length - this.slidesVisibles
            }else{
                return
            }
        } else if (index >= this.items.length || (this.items[this.currentItem + this.slidesVisibles] === undefined && index > this.currentItem)) {
            if (this.options.loop) {
                index = 0
            }else{
                return
            }
        }
        let translateX = index * -100 / this.items.length
        if (animation === false) {
            this.container.style.transition = 'none'
        }
        this.container.style.transform = 'translate3d(' + translateX + '%, 0, 0)'
        this.container.offsetHeight //force repaint
        if (animation === false) {
            this.container.style.transition = ''
        }
        this.currentItem = index
        this.moveCallBacks.forEach(cb => cb(index))
    }
    onMove(cb){
        this.moveCallBacks.push(cb)
    }
    get slideToScroll(){
        // return this.isMobile ? 1 : this.options.slideToScroll
        if(this.isMobile){
            return 1
        } else if (this.isTab){
            return 2
        } else {
            return this.options.slideToScroll
        }
    }
    get slidesVisibles(){
        // return this.isMobile ? 1 : this.options.slidesVisibles
        if(this.isMobile){
            return 1
        } else if (this.isTab){
            return 2
        } else {
            return this.options.slidesVisibles
        }
    }
    onWindowResize(){
        let mobile = window.innerWidth <= 600
        let tab = window.innerWidth < 1000
        if(mobile !== this.isMobile){
            this.isMobile = mobile
            this.moveCallBacks.forEach(cb => cb(this.currentItem))
            this.setStyle()
        }
        if(tab !== this.isTab){
            this.isTab = tab
            this.moveCallBacks.forEach(cb => cb(this.currentItem))
            this.setStyle()
        }
    }
    createPagination(){
        let pagination = this.createDivWithClass('carousselPagination')
        this.root.appendChild(pagination)
        let buttons = []
        for (let i = 0; i < (this.items.length - 2 * this.offset); i = i + this.options.slideToScroll) {
            let button = this.createDivWithClass('carousselBtn')
            button.addEventListener('click', () => this.gotoItem(i + this.offset))
            pagination.appendChild(button)
            buttons.push(button)
            this.onMove(index => {
                let count = this.items.length - 2 * this.offset
                let ActiveBtn = buttons[Math.floor((index - this.offset) % count / this.options.slideToScroll)]
                if (ActiveBtn) {
                    buttons.forEach(button => button.classList.remove('carousselBtnActive'))
                    ActiveBtn.classList.add('carousselBtnActive')
                }
            })
        }
    }
    resetInfinite(){
        if (this.currentItem <= this.options.slideToScroll) {
            this.gotoItem(this.currentItem + (this.items.length - 2 * this.offset), false)
        } else if (this.currentItem >= this.items.length - this.offset){
            this.gotoItem(this.currentItem - (this.items.length - 2 * this.offset), false)
        }
    }
}

document.addEventListener('DOMContentLoaded', function(){
    new Caroussel(document.querySelector('.caroussel'), {
        slideToScroll: 1,
        slidesVisibles: 4,
        loop: true,
        pagination: true,
        navigation: true,
        infinite: false,
        animated: true
    })
})

