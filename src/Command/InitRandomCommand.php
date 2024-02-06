<?php

namespace App\Command;

use App\Entity\RandomImage;
use App\Entity\RandomText;
use App\Repository\RandomImageRepository;
use App\Repository\RandomTextRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'InitRandom',
    description: 'Add a short description for your command',
)]
class InitRandomCommand extends Command
{

    public const REISI = 'reisi';
    public const GAFFEL = 'gaffel';
    public const FRUEH = 'frueh';

    public function __construct(private RandomImageRepository $imageRepository, private RandomTextRepository $textRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $urls = [
            self::GAFFEL =>
                [
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855831/koelsch-dreijestirn/gaffel/gaffel1_mjib0z.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855830/koelsch-dreijestirn/gaffel/gaffel2_qxncf0.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855830/koelsch-dreijestirn/gaffel/gaffel3_cidlhu.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855830/koelsch-dreijestirn/gaffel/gaffel4_tfrhkl.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855831/koelsch-dreijestirn/gaffel/gaffel5_ye9zn2.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855830/koelsch-dreijestirn/gaffel/gaffel6_ugrxub.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855830/koelsch-dreijestirn/gaffel/gaffel7_eloeve.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855830/koelsch-dreijestirn/gaffel/gaffel8_d5mekj.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855830/koelsch-dreijestirn/gaffel/gaffel9_ov1dge.jpg'
                ],
            self::FRUEH =>
                [
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855829/koelsch-dreijestirn/frueh/frueh1_n7ksaz.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855829/koelsch-dreijestirn/frueh/frueh2_bexbf3.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855829/koelsch-dreijestirn/frueh/frueh3_m6wxeq.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855829/koelsch-dreijestirn/frueh/frueh4_s3wzvp.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855829/koelsch-dreijestirn/frueh/frueh5_vkvzf8.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855830/koelsch-dreijestirn/frueh/frueh6_jsw6ho.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855829/koelsch-dreijestirn/frueh/frueh7_knxcze.jpg',
                    'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855829/koelsch-dreijestirn/frueh/frueh8_mrdpgn.jpg'
                ],
            self::REISI => [
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855832/koelsch-dreijestirn/reisi/reisi1_nsj0tb.jpg',
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855832/koelsch-dreijestirn/reisi/reisi2_we2kxx.jpg',
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855832/koelsch-dreijestirn/reisi/reisi3_hudj1r.jpg',
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855831/koelsch-dreijestirn/reisi/reisi4_uohmvh.jpg',
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855831/koelsch-dreijestirn/reisi/reisi5_e0a4bn.jpg',
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855832/koelsch-dreijestirn/reisi/reisi6_pfihlb.jpg',
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855832/koelsch-dreijestirn/reisi/reisi7_wvlp2q.jpg',
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855831/koelsch-dreijestirn/reisi/reisi8_h8zhgn.jpg',
                'https://res.cloudinary.com/dl4y4cfvs/image/upload/v1684855832/koelsch-dreijestirn/reisi/reisi9_hyvkfj.jpg'
            ]
        ];

        $texts = [
            self::GAFFEL =>
                [
                    '<span class="beer">Gaffel</span> rock&rsquo;s',
                    'Capt&rsquo;n <span class="beer">Gaffel</span> loves you',
                    'Effzeh-Fans trinken <span class="beer">Gaffel</span>',
                    'Binge-watchen mit <span class="beer">Gaffel</span>: nen Kasten pro Staffel',
                    'Kaffekränzchen: Deine Waffel isst du mit <span class="beer">Gaffel</span>',
                    'Es ist keine Fest-Tafel, steht drauf nicht ein <span class="beer">Gaffel</span>',
                    ],
            self::FRUEH =>
                [
                    '<span class="beer">Früh</span> rock&rsquo;s',
                    'Von früh bis spät, der Trinker sich das <span class="beer">Früh</span> reinlädt',
                    '<span class="beer">Früh</span> ein Bier, das lob ich mir',
                    'Zu trinken das <span class="beer">Früh</span>, ist keine Müh',
                    'Der fröhliche Trinker schnappt das <span class="beer">Früh</span> ',
                    'Morgenstund und trotzdem schon das <span class="beer">Früh</span> im Mund',
                ],
            self::REISI => [
                '<span class="beer">Reisi</span> rock&rsquo;s',
                '<span class="beer">Reisi</span> trinkt man am besten eisi',
                'Das Wasser vom Lande: <span class="beer">Reisi</span>',
                'Grundnahrungsmittel: Kartoffeln, Nudeln, <span class="beer">Reisi</span>',
                'Dorftombula: Erster Preis nen Kasten <span class="beer">Reiss</span>',
                'Ob Flugzeug, Bahn oder Auto: Am spaßigsten reist&rsquo;s sich mit <span class="beer">Reisi</span>',
            ]
        ];

        foreach ($urls as $beer => $images){
            foreach ($images as $entry){
                if (!$this->imageRepository->count(['imageUrl' => $entry])){
                    $random = new RandomImage();
                    $random->setOwner($beer);
                    $random->setImageUrl($entry);
                    $random->setCounter(0);
                    $this->imageRepository->save($random);
                }
            }
        }

        foreach ($texts as $beer => $entries){
            foreach ($entries as $entry){
                if (!$this->textRepository->count(['content' => $entry])){
                    $random = new RandomText();
                    $random->setOwner($beer);
                    $random->setContent($entry);
                    $random->setCounter(0);
                    $this->textRepository->save($random);
                }
            }
        }
        return Command::SUCCESS;
    }
}
