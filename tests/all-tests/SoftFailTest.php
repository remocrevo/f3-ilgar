<?php
use PHPUnit\Framework\TestCase;

class SoftFailTest extends TestCase
{
    protected $f3;
    
    protected function setUp() {
        $this->f3 = \F3::instance();
        $this->f3->set('ILGAR.path', dirname(__DIR__) . "/packages-test-3/");
        $this->f3->set('QUIET',TRUE);
        \Chez14\Ilgar\Boot::now();
    }

    public function testFirstStage() {
        \Chez14\Ilgar\Internal::instance()->reset_version();
        $this->f3->mock('GET /ilgar/migrate');
        $stats = \Chez14\Ilgar\Internal::instance()->get_stats();
        $this->assertSame(1, $stats['version']);
        $this->assertSame(1, $stats['success']);
        $this->assertNotNull($stats['last_exception']);
    }
}