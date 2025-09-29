// Mobile menu toggle functionality
    document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.style.display = sidebar.style.display === 'flex' ? 'none' : 'flex';
    });

    // Search functionality
    document.querySelector('.search-input').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const bookItems = document.querySelectorAll('.book-item');

      bookItems.forEach(item => {
        const title = item.querySelector('.book-title').textContent.toLowerCase();
        const author = item.querySelector('.book-author').textContent.toLowerCase();

        if (title.includes(searchTerm) || author.includes(searchTerm)) {
          item.style.display = 'flex';
        } else {
          item.style.display = searchTerm === '' ? 'flex' : 'none';
        }
      });
    });

    // Filter functionality
    // document.querySelectorAll('.right-sidebar .sidebar-item').forEach(item => {
    //   item.addEventListener('click', function() {
    //     // Remove active class from all items
    //     document.querySelectorAll('.right-sidebar .sidebar-item').forEach(i => i.classList.remove('active'));
    //     // Add active class to clicked item
    //     this.classList.add('active');

    //     const filterText = this.querySelector('span').textContent.toLowerCase();
    //     const bookItems = document.querySelectorAll('.book-item');

    //     if (filterText === 'leyendo') {
    //       // Show all books for "reading" filter
    //       bookItems.forEach(item => item.style.display = 'flex');
    //     } else {
    //       // Filter by genre
    //       bookItems.forEach(item => {
    //         const tags = item.querySelectorAll('.tag span');
    //         let hasTag = false;

    //         tags.forEach(tag => {
    //           if (tag.textContent.toLowerCase().includes(filterText)) {
    //             hasTag = true;
    //           }
    //         });

    //         item.style.display = hasTag ? 'flex' : 'none';
    //       });
    //     }
    //   });
    // });

    // Sidebar menu interactions
    document.querySelectorAll('.sidebar .menu-item').forEach(item => {
      item.addEventListener('click', function() {
        // Remove active state from all menu items
        document.querySelectorAll('.sidebar .menu-item').forEach(i => i.classList.remove('active'));
        // Add active state to clicked item
        this.classList.add('active');
      });
    });

    function handleSubmit(event) {
      event.preventDefault();

      // Get form data
      const formData = new FormData(event.target);
      const bookData = Object.fromEntries(formData.entries());

      // Simple validation
      const requiredFields = event.target.querySelectorAll('[required]');
      let isValid = true;

      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          field.style.borderColor = '#ef4444';
          isValid = false;
        } else {
          field.style.borderColor = '#f6e7ae';
        }
      });

      if (isValid) {
        // Simulate successful submission
        alert('Buku berhasil ditambahkan!');
        event.target.reset();
      } else {
        alert('Mohon lengkapi semua field yang wajib diisi.');
      }
    }

