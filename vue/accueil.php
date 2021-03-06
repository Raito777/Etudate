    <header>

        <div class="left-header">
            <div class="text-title">
                <h1>ETUDATE</h1>
                <p>Le site de rencontre pour étudiants</p>
            </div>
            <?php
              if(!checkUserSet()) {
            ?>
              <a href="inscription">Je m'inscris !</a>
            <?php
              } else {
            ?>
                <a href="match">Je match ♥</a>
            <?php
                }
            ?>
        </div>

        <div class="right-header">
            <img src="../vue/img/date_first_page.svg" alt="Rendez-vous">
        </div>

    </header>

    <main>

        <div class="first-content">
            <h2>Rencontres d'autres étudiants</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae magnam inventore animi, eius hic rem ut asperiores similique nesciunt facilis. Enim assumenda obcaecati reiciendis quos ad sit illo odit. Libero!</p>
        </div>

        <div class="info-text">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M512 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V96C576 60.65 547.3 32 512 32zM176 128c35.35 0 64 28.65 64 64s-28.65 64-64 64s-64-28.65-64-64S140.7 128 176 128zM272 384h-192C71.16 384 64 376.8 64 368C64 323.8 99.82 288 144 288h64c44.18 0 80 35.82 80 80C288 376.8 280.8 384 272 384zM496 320h-128C359.2 320 352 312.8 352 304S359.2 288 368 288h128C504.8 288 512 295.2 512 304S504.8 320 496 320zM496 256h-128C359.2 256 352 248.8 352 240S359.2 224 368 224h128C504.8 224 512 231.2 512 240S504.8 256 496 256zM496 192h-128C359.2 192 352 184.8 352 176S359.2 160 368 160h128C504.8 160 512 167.2 512 176S504.8 192 496 192z"/>
              </svg>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, quaerat corrupti quo similique in at error officia fuga aspernatur possimus tempora nobis atque molestias recusandae inventore ratione veniam nulla officiis.</p>
            </div>

            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M256 31.1c-141.4 0-255.1 93.12-255.1 208c0 49.62 21.35 94.98 56.97 130.7c-12.5 50.37-54.27 95.27-54.77 95.77c-2.25 2.25-2.875 5.734-1.5 8.734c1.249 3 4.021 4.766 7.271 4.766c66.25 0 115.1-31.76 140.6-51.39c32.63 12.25 69.02 19.39 107.4 19.39c141.4 0 255.1-93.13 255.1-207.1S397.4 31.1 256 31.1zM127.1 271.1c-17.75 0-32-14.25-32-31.1s14.25-32 32-32s32 14.25 32 32S145.7 271.1 127.1 271.1zM256 271.1c-17.75 0-31.1-14.25-31.1-31.1s14.25-32 31.1-32s31.1 14.25 31.1 32S273.8 271.1 256 271.1zM383.1 271.1c-17.75 0-32-14.25-32-31.1s14.25-32 32-32s32 14.25 32 32S401.7 271.1 383.1 271.1z"/>
                </svg>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, quaerat corrupti quo similique in at error officia fuga aspernatur possimus tempora nobis atque molestias recusandae inventore ratione veniam nulla officiis.</p>
            </div>
        </div>

    </main>


