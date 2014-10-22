<?php

/**
* 
*/
class Offers
{
    
    static public function getByCity($start, $end, $timestamp = '%')
    {
        $request = Database::$PDO->prepare('SELECT
                                                o.end_date, o.price, o.seats, u.name, u.surname, u.email, u.user_id
                                            FROM
                                                offers o, cities cs, cities ce, paths p, users u
                                            WHERE p.path_id     = o.path_id
                                              AND p.start_city  = cs.id
                                              AND p.end_city    = ce.id
                                              AND o.user_id     = u.user_id
                                              AND start_date LIKE ?
                                              AND cs.slug       = ?
                                              AND ce.slug       = ?'
                                          );
        $request->execute([$timestamp, $start, $end]);
        return $request->fetchAll(PDO::FETCH_NUM);
    }
}

