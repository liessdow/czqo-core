<?php

namespace App\Models\Network;

use App\Models\Roster\RosterMember;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

// Log of all sessions
class SessionLog extends Model
{
    use LogsActivity;

    // session_start and session_end are in format 'Y-m-d H:i:s'
    protected $fillable = [
        'id', 'roster_member_id', 'cid', 'session_start', 'session_end', 'monitored_position_id', 'duration', 'emails_sent',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->hasOne(MonitoredPosition::class, 'monitored_position_id');
    }

    public function rosterMember()
    {
        return $this->belongsTo(RosterMember::class);
    }

    protected $dates = [
        'session_start', 'session_end',
    ];
}
