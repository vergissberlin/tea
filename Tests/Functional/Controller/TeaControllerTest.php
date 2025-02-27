<?php

declare(strict_types=1);

namespace TTN\Tea\Tests\Functional\Controller;

use Nimut\TestingFramework\TestCase\FunctionalTestCase;

/**
 * @covers \TTN\Tea\Controller\TeaController
 */
class TeaControllerTest extends FunctionalTestCase
{
    /**
     * @var string[]
     */
    protected $testExtensionsToLoad = ['typo3conf/ext/tea'];

    /**
     * @var string[]
     */
    protected $coreExtensionsToLoad = ['fluid_styled_content'];

    protected function setUp(): void
    {
        parent::setUp();

        $this->importDataSet(__DIR__ . '/Fixtures/Database/pages.xml');
        $this->importDataSet(__DIR__ . '/../Domain/Repository/Fixtures/Product/Tea.xml');

        $this->setUpFrontendRootPage(
            1,
            [
                'EXT:fluid_styled_content/Configuration/TypoScript/setup.typoscript',
                'EXT:tea/Configuration/TypoScript/setup.typoscript',
                'EXT:tea/Tests/Functional/Controller/Fixtures/Frontend/Basic.typoscript',
            ]
        );
    }

    /**
     * @test
     */
    public function indexActionRendersTeaTitle(): void
    {
        $responseContent = $this->getFrontendResponse(1)->getContent();

        $teaTitle = 'Earl Grey';
        self::assertStringContainsString($teaTitle, $responseContent);
    }
}
