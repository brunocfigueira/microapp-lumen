<?php
namespace App\Http\Traits;

/**
 * Description of MessagesTraits
 *
 * @author BrunoFigueira
 */
trait MessagesTraits {

    public function msgSuccessStored($replace = null) {
        $replace = is_null($replace) ? trans('messages.register') : $replace;
        return trans('messages.success.stored', ['value' => $replace]);
    }

    public function msgSuccessUpdated($replace = null) {
        $replace = is_null($replace) ? trans('messages.register') : $replace;
        return trans('messages.success.updated', ['value' => $replace]);
    }

    public function msgSuccessDeleted($replace = null) {
        $replace = is_null($replace) ? trans('messages.register') : $replace;
        return trans('messages.success.deleted', ['value' => $replace]);
    }
    public function msgInfoZeroRecords($replace = null) {
        $replace = is_null($replace) ? trans('messages.register') : $replace;
        return trans('messages.info.zero_records', ['value' => $replace]);
    }

}