<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\User;

interface VoucherSorterInterface
{
    /**
     * @param \App\Dto\User $user
     * @param \App\Dto\Voucher[] $vouchers
     *
     * @return \App\Dto\Voucher[]
     */
    public function sort(User $user, array $vouchers);
}
