<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\OfferedProduct;
use App\Dto\User;
use App\Dto\Voucher;
use App\Service\VoucherSorterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/voucher', name: 'voucher')]
final class VoucherController extends AbstractController
{
    public function __construct(private VoucherSorterInterface $voucherSorter)
    {
    }

    public function __invoke(): Response
    {
        $vouchers = [
            Voucher::gift(
                '97619339013d8cdd98c3f9deb858a0b1021bb69b',
                'Free Cookie',
                0,
                OfferedProduct::product(['921273'])
            ),
            Voucher::gift(
                'rew_3b85546ab6',
                'Free Drinks (Category) (10 pts)',
                10,
                OfferedProduct::category(['ZT201520'])
            ),
            Voucher::gift(
                'rew_e1ed08780a',
                'No Product SKU (10 pts)',
                10,
                OfferedProduct::product()
            ),
            Voucher::gift(
                'rew_db0c639c8f',
                'No Category SKU (10 pts)',
                10,
                OfferedProduct::category()
            ),
            Voucher::amount(
                'rew_5438233c49',
                '€10 Discount (10 pts)',
                10
            ),
            Voucher::percentage(
                'rew_d0734bdfd0',
                '10% Discount (10 pts)',
                10
            ),
            Voucher::gift(
                'rew_4e753b6185',
                'Free Cookie (15 pts)',
                15,
                OfferedProduct::product(['921273'])
            ),
            Voucher::amount(
                'rew_ae98dc3ab6',
                '€100 Discount (500 pts)',
                500
            ),
        ];

        $user = new User(100);

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $newVouchers = $this->voucherSorter->sortByCriteria($user, $vouchers);

        return new JsonResponse(
            json_decode(
                $serializer->serialize($newVouchers, 'json'),
                false,
                512,
                JSON_THROW_ON_ERROR
            )
        );
    }
}
