class Header {
  headerTime() {
    return {
      time: new Date(),
      init() {
        setInterval(() => {
          this.time = new Date()
        }, 1000)
      },
      getDate() {
        return this.time.toLocaleDateString('id-ID', {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        })
      },
      getTime() {
        return this.time.toLocaleTimeString('id-ID', {
          hour: '2-digit',
          minute: '2-digit',
        }).replace('.', ':')
      }
    }
  }
}

window.HeaderController = new Header()