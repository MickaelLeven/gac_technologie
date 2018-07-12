<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\TicketRequest;
use Carbon\Carbon;
use App\Http\Requests\ImportTicketsRequest;
use DB;

class TicketController extends Controller {
    
    private $ticket;
    
    /**
     * Initialize
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket) {
    
        $this->ticket = $ticket;
    }
        
    /**
     * Get tickets
     * @return Response
     */
    public function list() {
        
        // Get tickets
        $tickets = $this->ticket->all();
        
        // return an html response
        return view('ticket.list', array( 
           
            'tickets' => $tickets 
        ));
   }
   
   /**
    * Get Ticket
    * @param Integer $id
    * @return Response
    */
   public function read($id) {

        // Get Ticket
        $ticket = $this->ticket->findOrFail($id);
        
        // return an html response
        return view('ticket.read', array(            
           
            'ticket' => $ticket
        ));
   }
   
   /**
    * Display Form to create a new ticket
    * 
    *  @return Response
    */
   public function createForm() {
       
       // return an html response
       return view('ticket.create');
   }
   
   /**
    * Create a new tickets
    * @param TicketRequests $request
    * @return Response
    */
   public function create(TicketRequest $request) {
      
      // Get data of request
      $data = $request->except(array('_token'));

      // Format date
      $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
         
      // Create ticket
      $ticket = $this->ticket->create($data);
      
      // Return an html reponse.
      if($ticket === null) {
          
          return redirect()->back()->withErrors('Une erreur est survenue lors de la création du ticket');
      }
      else {
          
          return redirect()->route('read-ticket', array('id' => $ticket->id));
      }
   }
   
   /**
    * Display Form to update an ticket
    * @param Integer $id
    * @return Response
    */
   public function updateForm($id) {
       
       // Get Ticket
       $ticket = $this->ticket->findOrFail($id);
       
       // Return an html response
       return view('ticket.update', array(
           
           'ticket' => $ticket
       ));
   }
   
   /**
    * Update an tickets
    * @param Integer $id
    * @param TicketRequests $request
    * @return Response
    */
   public function update($id, TicketRequest $request) {
       
       // Update ticket
       $success = $this->ticket->where('id', '=', $id)->update($request->except(array('_token')));
   
       // Return an html reponse
       if($success === false) {
           
           return redirect()->back()->withErrors('Une erreur est survenue lors de l\'enregistrement du ticket');
       }
       else {
           
           return redirect()->route('read-ticket', array('id' => $id));
       }
   }
   
   /**
    * Delete an ticket
    * @param Integer $id
    * @return Response
    */
   public function delete($id) {
       
       // Delete ticket
       $success = $this->ticket->where('id', '=', $id)->delete();
       
       // Return an html response.
       if($success === false) {
           
           return redirect()->back()->withErrors('Une erreur est survenue lors de la mise à jour du ticket');
       }
       else {
           
           return redirect()->route('list-tickets');
       }
   }
   
   /**
    * Display Form to Import Tickets
    * @return Response
    */
   public function importForm() {
       
       return view('ticket.import');
   }
   
   /**
    * Import tickets
    * @param ImportTicketsRequest $request
    * @return Response
    */
   public function import(ImportTicketsRequest $request) {
       
       $file = $request->file('csv_file');
       $file->move(public_path().'/uploads/', $file->getClientOriginalName());
       
       $datas = array_map('str_getcsv', file(url('/').'/uploads/'.$file->getClientOriginalName()));
       $nb_ligne_lu = 1;
       $datas_ticket = array();
       
       foreach($datas as $data) {
           
           if($nb_ligne_lu < 4) {
               
               $nb_ligne_lu++;
               continue;
           }
           
           $data = explode(';', $data[0]);
                          
           $data_ticket = array(
               'account_invoice' => $data[0],
               'invoice_id' => $data[1],
               'customer_id' => $data[2],
               'date' => Carbon::createFromFormat('d/m/Y', $data[3])->format('Y-m-d'),
               'time' => $data[4],
               'type' => utf8_encode($data[7]),
           );
           
           if(strlen($data[5]) === 8) {
               
               $data_ticket['duration'] = $data[5];
               $data_ticket['duration_invoice'] = $data[6];
           }
           elseif(!empty($data[5])) {
              
               $data_ticket['weight'] = $data[5];
               $data_ticket['weight_invoice'] = $data[6];
           }
           
           $datas_ticket[] = $data_ticket;
       }
       
       $datas_ticket_chunk = array_chunk($datas_ticket,  5);
       
       foreach($datas_ticket_chunk as $data_ticket_chunck) {
        
           $this->ticket->insert($data_ticket_chunck);
           
       }
   }
   
   /**
    * Display Statistique
    * @return Response
    */
   public function statistique() {
       
       $total_duration = DB::table('tickets')->selectRaw("sum(duration)")->where('type', 'like', '%appel%')->get();
       $number_ticket_sms = $this->ticket->where('type', 'like', '%sms%')->get()->count();
   }
}