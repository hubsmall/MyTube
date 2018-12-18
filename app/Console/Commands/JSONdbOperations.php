<?php

namespace App\Console\Commands;

use App\Models\Playlist;
use App\Models\Video;
use App\Models\Chanel;

class JSONdbOperations {

    protected static function setModelPrimaryKeyValue($existingInfo) {
        $modelPrimaryKeyValue = 1;
        $modelsCollection = collect($existingInfo);
        if (!$modelsCollection->isEmpty()) {
            $lastModelId = $modelsCollection->sortBy('id')->last()->id;
            $modelPrimaryKeyValue = $lastModelId + 1;
        }
        return $modelPrimaryKeyValue;
    }

    public static function writeToJson($model, $modelName) {
        $existingInfo = \Storage::disk('local')->exists($modelName . '.json') ? json_decode(\Storage::disk('local')->get($modelName . '.json')) : [];
        $model->id = self::setModelPrimaryKeyValue($existingInfo);
        array_push($existingInfo, $model);
        \Storage::disk('local')->put($modelName . '.json', json_encode($existingInfo));
        return $model;
    }

    public static function writeCollectionToJson($collection, $modelName) {
        \Storage::disk('local')->put($modelName . '.json', json_encode($collection));
    }

    public static function readFromJson($modelName) {
        $existingInfo = \Storage::disk('local')->exists($modelName . '.json') ? json_decode(\Storage::disk('local')->get($modelName . '.json')) : [];
        return $existingInfo;
    }

    public static function addChanel($model) {

        return self::writeToJson($model, 'Chanel');
    }

    public static function addPlaylist($model) {
        return self::writeToJson($model, 'Playlist');
    }

    public static function addVideo($model) {
        return self::writeToJson($model, 'Video');
    }

    private static function collectionToArray($collection) {
        $array = [];
        foreach ($collection as $model) {
            $model = $model->toArray();
            array_push($array, (object) $model);
        }
        return $array;
    }

    public static function updateVideoPlayList($model, $playlist_id) {

        $video = self::convertToVideo(self::readFromJson('Video'))->where('id', $model->id)->first();
        $video->playlist_id = $playlist_id;
        $withoutCurrentModel = self::convertToVideo(self::readFromJson('Video'))->whereNotIn(
                'id', [$video->id]);
        $models = $withoutCurrentModel->push($video)->sortBy('id');
        $models = self::collectionToArray($models);
        self::writeCollectionToJson($models, 'Video');
    }

    public static function convertToChanel($objects) {
        $Chanels = Chanel::hydrate($objects);
        return $Chanels;
    }

    public static function convertToPlaylist($objects) {
        $Playlists = Playlist::hydrate($objects);
        return $Playlists;
    }

    public static function convertToVideo($objects) {
        $Videos = Video::hydrate($objects);
        return $Videos;
    }

    public static function allChanels() {
        $allChanels = self::convertToChanel(self::readFromJson('Chanel'));
        return $allChanels;
    }

    public static function attachAllInfoToVideos($videoCollection) {
        foreach ($videoCollection as $video) {
            $videoPlaylist = self::convertToPlaylist(self::readFromJson('Playlist'))->where('id', $video->playlist_id)->first();
            $videoChanel = self::convertToChanel(self::readFromJson('Chanel'))->where('id', $videoPlaylist->chanel_id)->first();
            $videoPlaylist->chanel = $videoChanel;
            $video->playlist = $videoPlaylist;
        }
        return $videoCollection;
    }

    public static function latestVideos() {
        $latestVideos = self::convertToVideo(self::readFromJson('Video'))->sortByDesc('original_date')->take(6);
        return self::attachAllInfoToVideos($latestVideos);
    }

    public static function randomVideos() {
        $randomVideos = self::convertToVideo(self::readFromJson('Video'))->random(6);
        return self::attachAllInfoToVideos($randomVideos);
    }

    public static function chanelPlaylists($chanel) {
        $playlists = self::convertToPlaylist(self::readFromJson('Playlist'))->where('chanel_id', $chanel)->all();
        return $playlists;
    }

    public static function getLimitedVideos($playlist_id) {
        return self::convertToVideo(self::readFromJson('Video'))->where('playlist_id', $playlist_id)
                        ->sortByDesc('original_date')->take(2);
    }

    public static function allInfo() {
        $allChanels = collect(self::convertToChanel(self::readFromJson('Chanel')));
        foreach ($allChanels as $chanel) {
            $playlists = self::convertToPlaylist(self::readFromJson('Playlist'))->where('chanel_id', $chanel->id);
            foreach ($playlists as $playlist) {
                $videos = self::convertToVideo(self::readFromJson('Video'))->where('playlist_id', $playlist->id);
                $playlist->videos = $videos;
            }
            $chanel->playlists = $playlists;
        }
        return $allChanels;
    }

}
