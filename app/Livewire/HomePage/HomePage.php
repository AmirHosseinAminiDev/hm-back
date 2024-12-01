<?php

namespace App\Livewire\HomePage;

use App\Services\HomePageService;
use Livewire\Component;

class HomePage extends Component
{
    public $homePageData;
    protected $apiService;



    public function __construct()
    {
        $this->apiService = app(HomePageService::class);
    }

    public function mount()
    {
        try {
            $categoryId = null;
            $this->homePageData = json_decode($this->apiService->getData('home-page' , [], $categoryId), true);
        } catch (\Exception $exception) {
            $this->addError('api_error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.home-page.home-page', [
            'homePageData' => $this->homePageData
        ])->layout('layout.app');
    }

    public function getCategoryQuestions($categoryId)
    {
        try {
            $this->homePageData = json_decode($this->apiService->getData('home-page' , [], $categoryId), true);
        } catch (\Exception $exception) {
            $this->addError('api_error', $exception->getMessage());
        }
    }
}
