<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\TicketRequest;
use Carbon\Carbon;

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
}