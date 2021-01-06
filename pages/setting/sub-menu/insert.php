<?php
include('../../../config/config.php');

if (!empty($_SESSION['login'])) {
?>
  <div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <label>Tipe Menu</label>
        <select name="i_menuType" id="i_menuType" class="form-control">
          <option value="">-- Pilih --</option>
          <option value="side-bar">SideBar</option>
          <option value="top-bar">TopBar</option>
        </select>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <label>Menu Utama <i id="searchResult"></i> </label>
        <select name="i_mainMenu" id="i_mainMenu" class="form-control">
          <option value="">-- Pilih Tipe Menu --</option>
        </select>
      </div>
    </div>

    <div class="col-md-8">
      <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" class="form-control" name="i_submenuDescription" id="i_submenuDescription" placeholder="Deskripsi Sub Menu">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Kode</label>
        <input type="text" class="form-control" name="i_submenuCode" id="i_submenuCode" placeholder="Kode Sub Menu">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Url</label>
        <input type="text" class="form-control" name="i_submenuUrl" id="i_submenuUrl" placeholder="Url Sub Menu">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group ui-widget">
        <label>Icon <i class="displayIcon"></i></label>
        <input type="text" class="form-control" name="i_submenuIcon" id="i_submenuIcon" placeholder="Icon Sub Menu">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Urutan</label>
        <input type="text" class="form-control" name="i_submenuSort" id="i_submenuSort" placeholder="Urutan Sub Menu">
      </div>
    </div>
    <div class="col-md-9">
      <div class="form-group">
        <label>Direktori Modul</label>
        <input type="text" class="form-control" name="i_moduleDirectory" id="i_moduleDirectory" placeholder="Direktori Modul">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Aktif</label>
        <input type="checkbox" checked="" name="i_submenuIsActive" id="i_submenuIsActive" placeholder="Urutan Sub Menu" value="A">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <legend></legend>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="form-group">
        <div id="resultInsert"></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" id="buttonInsert">Submit</button>
        <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(function() {
      var availableTags = [
        "500px", "address-book", "address-book-o", "address-card", "address-card-o", "adjust", "adn", "align-center", "align-justify", "align-left", "align-right", "amazon", "ambulance", "american-sign-language-interpreting", "anchor", "android", "angellist", "angle-double-down", "angle-double-left", "angle-double-right", "angle-double-up", "angle-down", "angle-left", "angle-right", "angle-up", "apple", "archive", "area-chart", "arrow-circle-down", "arrow-circle-left", "arrow-circle-o-down", "arrow-circle-o-left", "arrow-circle-o-right", "arrow-circle-o-up", "arrow-circle-right", "arrow-circle-up", "arrow-down", "arrow-left", "arrow-right", "arrow-up", "arrows", "arrows-alt", "arrows-h", "arrows-v", "asl-interpreting", "assistive-listening-systems", "asterisk", "at", "audio-description", "automobile", "backward", "balance-scale", "ban", "bandcamp", "bank", "bar-chart", "bar-chart-o", "barcode", "bars", "bath", "bathtub", "battery", "battery-0", "battery-1", "battery-2", "battery-3", "battery-4", "battery-empty", "battery-full", "battery-half", "battery-quarter", "battery-three-quarters", "bed", "beer", "behance", "behance-square", "bell", "bell-o", "bell-slash", "bell-slash-o", "bicycle", "binoculars", "birthday-cake", "bitbucket", "bitbucket-square", "bitcoin", "black-tie", "blind", "bluetooth", "bluetooth-b", "bold", "bolt", "bomb", "book", "bookmark", "bookmark-o", "braille", "briefcase", "btc", "bug", "building", "building-o", "bullhorn", "bullseye", "bus", "buysellads", "cab", "calculator", "calendar", "calendar-check-o", "calendar-minus-o", "calendar-o", "calendar-plus-o", "calendar-times-o", "camera", "camera-retro", "car", "caret-down", "caret-left", "caret-right", "caret-square-o-down", "caret-square-o-left", "caret-square-o-right", "caret-square-o-up", "caret-up", "cart-arrow-down", "cart-plus", "cc", "cc-amex", "cc-diners-club", "cc-discover", "cc-jcb", "cc-mastercard", "cc-paypal", "cc-stripe", "cc-visa", "certificate", "chain", "chain-broken", "check", "check-circle", "check-circle-o", "check-square", "check-square-o", "chevron-circle-down", "chevron-circle-left", "chevron-circle-right", "chevron-circle-up", "chevron-down", "chevron-left", "chevron-right", "chevron-up", "child", "chrome", "circle", "circle-o", "circle-o-notch", "circle-thin", "clipboard", "clock-o", "clone", "close", "cloud", "cloud-download", "cloud-upload", "cny", "code", "code-fork", "codepen", "codiepie", "coffee", "cog", "cogs", "columns", "comment", "comment-o", "commenting", "commenting-o", "comments", "comments-o", "compass", "compress", "connectdevelop", "contao", "copy", "copyright", "creative-commons", "credit-card", "credit-card-alt", "crop", "crosshairs", "css3", "cube", "cubes", "cut", "cutlery", "dashboard", "dashcube", "database", "deaf", "deafness", "dedent", "delicious", "desktop", "deviantart", "diamond", "digg", "dollar", "dot-circle-o", "download", "dribbble", "drivers-license", "drivers-license-o", "dropbox", "drupal", "edge", "edit", "eercast", "eject", "ellipsis-h", "ellipsis-v", "empire", "envelope", "envelope-o", "envelope-open", "envelope-open-o", "envelope-square", "envira", "eraser", "etsy", "eur", "euro", "exchange", "exclamation", "exclamation-circle", "exclamation-triangle", "expand", "expeditedssl", "external-link", "external-link-square", "eye", "eye-slash", "eyedropper", "fa", "facebook", "facebook-f", "facebook-official", "facebook-square", "fast-backward", "fast-forward", "fax", "feed", "female", "fighter-jet", "file", "file-archive-o", "file-audio-o", "file-code-o", "file-excel-o", "file-image-o", "file-movie-o", "file-o", "file-pdf-o", "file-photo-o", "file-picture-o", "file-powerpoint-o", "file-sound-o", "file-text", "file-text-o", "file-video-o", "file-word-o", "file-zip-o", "files-o", "film", "filter", "fire", "fire-extinguisher", "firefox", "first-order", "flag", "flag-checkered", "flag-o", "flash", "flask", "flickr", "floppy-o", "folder", "folder-o", "folder-open", "folder-open-o", "font", "font-awesome", "fonticons", "fort-awesome", "forumbee", "forward", "foursquare", "free-code-camp", "frown-o", "futbol-o", "gamepad", "gavel", "gbp", "ge", "gear", "gears", "genderless", "get-pocket", "gg", "gg-circle", "gift", "git", "git-square", "github", "github-alt", "github-square", "gitlab", "gittip", "glass", "glide", "glide-g", "globe", "google", "google-plus", "google-plus-circle", "google-plus-official", "google-plus-square", "google-wallet", "graduation-cap", "gratipay", "grav", "group", "h-square", "hacker-news", "hand-grab-o", "hand-lizard-o", "hand-o-down", "hand-o-left", "hand-o-right", "hand-o-up", "hand-paper-o", "hand-peace-o", "hand-pointer-o", "hand-rock-o", "hand-scissors-o", "hand-spock-o", "hand-stop-o", "handshake-o", "hard-of-hearing", "hashtag", "hdd-o", "header", "headphones", "heart", "heart-o", "heartbeat", "history", "home", "hospital-o", "hotel", "hourglass", "hourglass-1", "hourglass-2", "hourglass-3", "hourglass-end", "hourglass-half", "hourglass-o", "hourglass-start", "houzz", "html5", "i-cursor", "id-badge", "id-card", "id-card-o", "ils", "image", "imdb", "inbox", "indent", "industry", "info", "info-circle", "inr", "instagram", "institution", "internet-explorer", "intersex", "ioxhost", "italic", "joomla", "jpy", "jsfiddle", "key", "keyboard-o", "krw", "language", "laptop", "lastfm", "lastfm-square", "leaf", "leanpub", "legal", "lemon-o", "level-down", "level-up", "life-bouy", "life-buoy", "life-ring", "life-saver", "lightbulb-o", "line-chart", "link", "linkedin", "linkedin-square", "linode", "linux", "list", "list-alt", "list-ol", "list-ul", "location-arrow", "lock", "long-arrow-down", "long-arrow-left", "long-arrow-right", "long-arrow-up", "low-vision", "magic", "magnet", "mail-forward", "mail-reply", "mail-reply-all", "male", "map", "map-marker", "map-o", "map-pin", "map-signs", "mars", "mars-double", "mars-stroke", "mars-stroke-h", "mars-stroke-v", "maxcdn", "meanpath", "medium", "medkit", "meetup", "meh-o", "mercury", "microchip", "microphone", "microphone-slash", "minus", "minus-circle", "minus-square", "minus-square-o", "mixcloud", "mobile", "mobile-phone", "modx", "money", "moon-o", "mortar-board", "motorcycle", "mouse-pointer", "music", "navicon", "neuter", "newspaper-o", "object-group", "object-ungroup", "odnoklassniki", "odnoklassniki-square", "opencart", "openid", "opera", "optin-monster", "outdent", "pagelines", "paint-brush", "paper-plane", "paper-plane-o", "paperclip", "paragraph", "paste", "pause", "pause-circle", "pause-circle-o", "paw", "paypal", "pencil", "pencil-square", "pencil-square-o", "percent", "phone", "phone-square", "photo", "picture-o", "pie-chart", "pied-piper", "pied-piper-alt", "pied-piper-pp", "pinterest", "pinterest-p", "pinterest-square", "plane", "play", "play-circle", "play-circle-o", "plug", "plus", "plus-circle", "plus-square", "plus-square-o", "podcast", "power-off", "print", "product-hunt", "puzzle-piece", "qq", "qrcode", "question", "question-circle", "question-circle-o", "quora", "quote-left", "quote-right", "ra", "random", "ravelry", "rebel", "recycle", "reddit", "reddit-alien", "reddit-square", "refresh", "registered", "remove", "renren", "reorder", "repeat", "reply", "reply-all", "resistance", "retweet", "rmb", "road", "rocket", "rotate-left", "rotate-right", "rouble", "rss", "rss-square", "rub", "ruble", "rupee", "s15", "safari", "save", "scissors", "scribd", "search", "search-minus", "search-plus", "sellsy", "send", "send-o", "server", "share", "share-alt", "share-alt-square", "share-square", "share-square-o", "shekel", "sheqel", "shield", "ship", "shirtsinbulk", "shopping-bag", "shopping-basket", "shopping-cart", "shower", "sign-in", "sign-language", "sign-out", "signal", "signing", "simplybuilt", "sitemap", "skyatlas", "skype", "slack", "sliders", "slideshare", "smile-o", "snapchat", "snapchat-ghost", "snapchat-square", "snowflake-o", "soccer-ball-o", "sort", "sort-alpha-asc", "sort-alpha-desc", "sort-amount-asc", "sort-amount-desc", "sort-asc", "sort-desc", "sort-down", "sort-numeric-asc", "sort-numeric-desc", "sort-up", "soundcloud", "space-shuttle", "spinner", "spoon", "spotify", "square", "square-o", "stack-exchange", "stack-overflow", "star", "star-half", "star-half-empty", "star-half-full", "star-half-o", "star-o", "steam", "steam-square", "step-backward", "step-forward", "stethoscope", "sticky-note", "sticky-note-o", "stop", "stop-circle", "stop-circle-o", "street-view", "strikethrough", "stumbleupon", "stumbleupon-circle", "subscript", "subway", "suitcase", "sun-o", "superpowers", "superscript", "support", "table", "tablet", "tachometer", "tag", "tags", "tasks", "taxi", "telegram", "television", "tencent-weibo", "terminal", "text-height", "text-width", "th", "th-large", "th-list", "themeisle", "thermometer", "thermometer-0", "thermometer-1", "thermometer-2", "thermometer-3", "thermometer-4", "thermometer-empty", "thermometer-full", "thermometer-half", "thermometer-quarter", "thermometer-three-quarters", "thumb-tack", "thumbs-down", "thumbs-o-down", "thumbs-o-up", "thumbs-up", "ticket", "times", "times-circle", "times-circle-o", "times-rectangle", "times-rectangle-o", "tint", "toggle-down", "toggle-left", "toggle-off", "toggle-on", "toggle-right", "toggle-up", "trademark", "train", "transgender", "transgender-alt", "trash", "trash-o", "tree", "trello", "tripadvisor", "trophy", "truck", "try", "tty", "tumblr", "tumblr-square", "turkish-lira", "tv", "twitch", "twitter", "twitter-square", "umbrella", "underline", "undo", "universal-access", "university", "unlink", "unlock", "unlock-alt", "unsorted", "upload", "usb", "usd", "user", "user-circle", "user-circle-o", "user-md", "user-o", "user-plus", "user-secret", "user-times", "users", "vcard", "vcard-o", "venus", "venus-double", "venus-mars", "viacoin", "viadeo", "viadeo-square", "video-camera", "vimeo", "vimeo-square", "vine", "vk", "volume-control-phone", "volume-down", "volume-off", "volume-up", "warning", "wechat", "weibo", "weixin", "whatsapp", "wheelchair", "wheelchair-alt", "wifi", "wikipedia-w", "window-close", "window-close-o", "window-maximize", "window-minimize", "window-restore", "windows", "won", "wordpress", "wpbeginner", "wpexplorer", "wpforms", "wrench", "xing", "xing-square", "y-combinator", "y-combinator-square", "yahoo", "yc", "yc-square", "yelp", "yen", "yoast", "youtube", "youtube-play", "youtube-square"
      ];

      $("#i_submenuIcon").autocomplete({
        source: availableTags
      });

    });

    $("#i_menuType").change(function() {
      var i_menuType = $("#i_menuType").val();
      $('#searchResult').html('<img src="<?php echo $base_url . "assets/images/load.gif" ?>" width="15" height="15"/>');
      $('#searchResult').show();
      $.ajax({
        type: "POST",
        dataType: "html",
        url: '<?php echo $base_url . 'pages/setting/sub-menu/mainMenu.php'; ?>',
        data: "i_menuType=" + i_menuType,
        success: function(msg) {
          $("#i_mainMenu").html(msg);
          $('#searchResult').hide();
        }
      });
    });

    $(document).ready(function() {
      $("#i_menuType").focus();
    });

    $('#i_menuType').change(function(e) {
      if ($('#i_menuType').val() == '') {
        toastr["error"]("Tipe Menu Belum Di pilih!");
        $('#i_menuType').focus();
      } else {
        $('#i_mainMenu').focus();
      }
    });

    $('#i_mainMenu').change(function(e) {
      if ($('#i_mainMenu').val() == '') {
        toastr["error"]("Menu utama belum di pilih!");
        $('#i_mainMenu').focus();
      } else {
        $('#i_submenuDescription').focus();
      }
    });

    $('#i_submenuDescription').keyup(function(e) {
      if (e.keyCode == 13) {
        if ($('#i_submenuDescription').val() == '') {
          toastr["error"]("Deskripsi Sub Menu Harus Di Isi!");
          $('#i_submenuDescription').focus();
        } else {
          $('#i_submenuCode').focus();
        }
      }
    });
    $('#i_submenuCode').keyup(function(e) {
      if (e.keyCode == 13) {
        if ($('#i_submenuCode').val() == '') {
          toastr["error"]("Kode Sub Menu Harus Di Isi!");
          $('#i_submenuCode').focus();
        } else {
          $('#i_submenuUrl').focus();
        }
      }
    });

    $('#i_submenuUrl').keyup(function(e) {
      if (e.keyCode == 13) {
        if ($('#i_submenuUrl').val() == '') {
          toastr["error"]("URL Harus Di Isi!");
          $('#i_submenuUrl').focus();
        } else {
          $('#i_submenuIcon').focus();
        }
      }
    });

    $('#i_submenuIcon').keyup(function(e) {
      if (e.keyCode == 13) {
        if ($('#i_submenuIcon').val() == '') {
          toastr["error"]("Icon Harus Di isi.");
          $('#i_submenuIcon').focus();
        } else {
          $('#i_submenuSort').focus();
        }
      }
    });

    $('#i_submenuSort').keyup(function(e) {
      if (e.keyCode == 13) {
        if ($('#i_submenuSort').val() == '') {
          toastr["error"]("Urutan Harus Di isi.");
          $('#i_submenuSort').focus();
        } else {
          $('#i_moduleDirectory').focus();
        }
      }
    });

    $('#i_moduleDirectory').keyup(function(e) {
      if (e.keyCode == 13) {
        if ($('#i_moduleDirectory').val() == '') {
          toastr["error"]("Direktori Menu Harus Di isi.");
          $('#i_moduleDirectory').focus();
        } else {
          $('#i_submenuIsActive').focus();
        }
      }
    });

    $('#i_submenuIsActive').keyup(function(e) {
      if (e.keyCode == 13) {
        $('#buttonInsert').focus();
      }
    });

    $("#buttonInsert").click(function(event) {
      insertData();
    });

    function insertData() {
      var i_menuType = $("#i_menuType").val();
      var i_mainMenu = $("#i_mainMenu").val();
      var i_submenuDescription = $("#i_submenuDescription").val();
      var i_submenuCode = $("#i_submenuCode").val();
      var i_submenuUrl = $("#i_submenuUrl").val();
      var i_submenuIcon = $("#i_submenuIcon").val();
      var i_submenuSort = $("#i_submenuSort").val();
      var i_submenuType = $("#i_submenuType").val();
      var i_moduleDirectory = $("#i_moduleDirectory").val();
      var i_submenuIsActive = $("#i_submenuIsActive").val();

      var i_submenuIsActive = [];
      $('#i_submenuIsActive').each(function() {
        if ($(this).is(":checked")) {
          i_submenuIsActive.push($(this).val());
        }
      });
      i_submenuIsActive = i_submenuIsActive.toString();

      if (i_menuType == '') {
        toastr["error"]("Tipe Menu Belum Dipilih!");
        $("#i_menuType").focus();
      } else if (i_mainMenu == '') {
        toastr["error"]("Menu Utama Belum Dipilih!");
        $("#i_mainMenu").focus();
      } else if (i_submenuDescription == '') {
        toastr["error"]("Deskripsi Harus Di Isi!");
        $("#i_submenuDescription").focus();
      } else if (i_submenuCode == '') {
        toastr["error"]("Kode Harus Di Isi!");
        $("#i_submenuCode").focus();
      } else if (i_submenuIcon == '') {
        toastr["error"]("Icon Harus Diisi!");
        $("#i_submenuIcon").focus();
      } else if (i_submenuSort == '') {
        toastr["error"]("Urutan Sub Menu");
        $("#i_submenuSort").focus();
      } else if (i_submenuType == '') {
        toastr["error"]("Tipe Sub Menu Harus Dipilih!");
        $("#i_submenuType").focus();
      } else if (i_moduleDirectory == '') {
        toastr["error"]("Direktori Menu Harus Dipilih!");
        $("#i_moduleDirectory").focus();
      } else {
        // AJAX Insert
        disableButtonInsert();
        $("#resultInsert").html("<img src='<?php echo $base_url . "assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
        $.ajax({
          type: "post",
          url: "<?php echo $base_url . "pages/setting/sub-menu/save.php" ?>",
          data: {
            i_mainMenu: i_mainMenu,
            i_submenuDescription: i_submenuDescription,
            i_submenuCode: i_submenuCode,
            i_submenuUrl: i_submenuUrl,
            i_submenuIcon: i_submenuIcon,
            i_submenuSort: i_submenuSort,
            i_submenuType: i_submenuType,
            i_submenuIsActive: i_submenuIsActive,
            i_moduleDirectory: i_moduleDirectory
          },
          success: function(data) {
            $("#resultInsert").html(data);
          }
        });
      }
    }
  </script>

<?php
} elseif (empty($_SESSION['login'])) {
?>
  <script type="text/javascript">
    alert("sesi anda habis, silahkan login kembali");
    window.location = "<?php echo $base_url . "" ?>";
  </script>
<?php
}
?>