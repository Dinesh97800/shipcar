<footer class="footer text-center">
    <div
        style="position: fixed; bottom: 0; width: -webkit-fill-available; text-align: center; display: flex; justify-content: center; align-items: center; height: 50px;">
        All Rights Reserved by <a href="/admin" class="text-client" style="font-weight: 600;">CredBnk</a> .
    </div>
</footer>
</div>
</div>
</div>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        var sidebar = document.querySelector('.sidebar');
        var navbar = document.querySelector('.navbar-custom');
        var mainContent = document.querySelector('.main');

        sidebar.classList.toggle('collapsed');
        navbar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>