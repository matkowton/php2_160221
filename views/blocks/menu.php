<ul class="nav justify-content-end">
           <?php foreach ($menu as $item): ?>
               <li class="nav-item">
                   <a class="nav-link active" href="<?= $item['link'] ?>">
                       <?= $item['title'] ?>
                   </a>
               </li>
           <?php endforeach; ?>
       </ul>