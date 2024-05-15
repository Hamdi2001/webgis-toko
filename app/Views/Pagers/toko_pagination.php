<?php $pager->setSurroundCount(3) ?>
<div class="container d-flex justify-content-center">
    <div class="row">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($pager->hasPrevious()) : ?>
                    <?php if ($pager->getCurrentPageNumber() > 3) : ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                                <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                            <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                        </a>
                    </li>
                <?php endif ?>

                <?php foreach ($pager->links() as $link): ?>
                    <li class="page-item <?= $link['active'] ? "active" : '' ?>">
                        <a class="page-link" href="<?= $link['uri'] ?>">
                            <?= $link['title'] ?>
                        </a>
                    </li>
                <?php endforeach ?>

                <?php if ($pager->hasNext()) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                            <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                        </a>
                    </li>
                    <?php if ($pager->getCurrentPageNumber() < $pager->getLastPageNumber() - 2) : ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                                <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                            </a>
                        </li>
                    <?php endif ?>
                <?php endif ?>
            </ul>
        </nav>
    </div>
</div>